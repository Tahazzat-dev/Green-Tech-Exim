# Green Tech Exim Mobile App Requirements

## Goal

Build a React Native mobile app for users only. The app should use an API-first Laravel backend. The mobile app will not include any admin feature, and admin accounts must not be allowed to log in through the mobile API.

The mobile app should match the current web app behavior:

- Guests can browse categories.
- Guests can browse products/trophies.
- Guests can view product details.
- Guests cannot see product prices.
- Guests should see "Login for price details" wherever prices would normally appear.
- Users can register.
- Approved users can log in with phone, PIN, and device ID.
- Logged-in users can see discounted prices.
- Users can view contact/executive information.
- Users can log out.
- Admin users cannot log in to the mobile app.

## API-First Development Order

Build the Laravel API before starting the React Native screens. This keeps the mobile app simple because every screen can be built against stable API responses.

Recommended order:

1. Finalize mobile API response shapes.
2. Update API authentication rules.
3. Add public catalog APIs.
4. Add authenticated user APIs.
5. Test all APIs with Postman or Insomnia.
6. Create the React Native project.
7. Build the API client and token storage.
8. Build guest screens.
9. Build login and registration.
10. Add authenticated price visibility.
11. Build contact screen.
12. Polish mobile UI.
13. Test Android/iOS builds.

## Backend Requirements

### 1. Authentication Rules

The mobile app must only allow normal users.

Admin accounts must be rejected even if phone and PIN are correct.

In `App\Http\Controllers\Api\AuthController@login`, after finding the user, add a role check:

```php
if ($user->role !== 'user') {
    return response()->json([
        'message' => 'This account is not allowed on the mobile app.',
    ], 403);
}
```

Login should continue to check:

- User exists.
- User role is `user`.
- User status is not `pending`.
- User status is not `blocked`.
- User status is not `rejected`.
- PIN is correct.
- Device ID matches the saved device ID, or admin has allowed the next device change.
- If user has no saved device ID, the first correct login claims the submitted device ID.

Mobile device fields on `users`:

- `device_id`: the only currently allowed mobile device.
- `device_change_allowed`: admin-controlled boolean permission for one new-device login.

### 2. User Registration API

Existing endpoint:

```http
POST /api/register
```

Required fields:

```json
{
    "name": "Customer Name",
    "phone": "01700000000",
    "shop_name": "Customer Shop",
    "city_area": "Dhaka",
    "pin": "1234",
    "pin_confirmation": "1234",
    "device_id": "mobile-device-id",
    "photo": "optional image file"
}
```

Expected behavior:

- Create user with role `user`.
- Store hashed `pin`.
- Store visible `plain_pin` for admin support.
- Store `device_id`.
- Store `device_change_allowed` as `false`.
- Set status to `pending`.
- User cannot log in until admin approves them.

Successful response:

```json
{
    "message": "Registration successful. Waiting for approval."
}
```

### 3. Login API

Existing endpoint:

```http
POST /api/login
```

Request:

```json
{
    "phone": "01700000000",
    "pin": "1234",
    "device_id": "mobile-device-id"
}
```

Successful response:

```json
{
    "token": "sanctum-token",
    "user": {
        "id": 1,
        "name": "Customer Name",
        "phone": "01700000000",
        "shop_name": "Customer Shop",
        "city_area": "Dhaka",
        "photo": "users/photo.jpg",
        "photo_url": "https://example.com/storage/users/photo.jpg",
        "status": "approved",
        "discount": 5,
        "device_id": "mobile-device-id"
    }
}
```

Failure responses:

Invalid credentials:

```json
{
    "message": "Invalid credentials"
}
```

Pending user:

```json
{
    "message": "Account pending approval"
}
```

Blocked user:

```json
{
    "message": "Account blocked"
}
```

Rejected user:

```json
{
    "message": "Account rejected"
}
```

Admin login attempt:

```json
{
    "message": "This account is not allowed on the mobile app."
}
```

Wrong device:

```json
{
    "message": "Device not authorized"
}
```

New-device login after admin allows it:

- Request is the same as normal login.
- User must provide correct phone and PIN.
- Submitted `device_id` may be different.
- Backend deletes previous mobile tokens.
- Backend replaces old `device_id` with submitted `device_id`.
- Backend sets `device_change_allowed` back to `false`.
- Response is the normal successful login response.

### 4. Logout API

Endpoint:

```http
POST /api/logout
```

Headers:

```http
Authorization: Bearer sanctum-token
```

Response:

```json
{
    "message": "Logged out"
}
```

### 5. Current User API

Add endpoint:

```http
GET /api/me
```

Middleware:

```php
auth:sanctum
```

Response:

```json
{
    "id": 1,
    "name": "Customer Name",
    "phone": "01700000000",
    "shop_name": "Customer Shop",
    "city_area": "Dhaka",
    "photo_url": "https://example.com/storage/users/photo.jpg",
    "status": "approved",
    "discount": 5
}
```

If authenticated user is not role `user`, return:

```json
{
    "message": "This account is not allowed on the mobile app."
}
```

## Catalog API Requirements

Catalog APIs should support both guest and logged-in users.

Important rule:

Do not send product price fields to guests. Do not only hide prices in the mobile app. The API must hide price data from unauthenticated users.

### 1. Public Categories API

Endpoint:

```http
GET /api/categories
```

Authentication:

Optional. Guests can access this.

Response:

```json
{
    "data": [
        {
            "id": 1,
            "name": "Trophy Category",
            "slug": "trophy-category",
            "image_url": "https://example.com/storage/categories/image.jpg"
        }
    ]
}
```

Implementation notes:

- Use `Category::latest()->get()`.
- Return absolute `image_url`.
- Use default trophy image URL if category image is missing.

### 2. Products By Category API

Endpoint:

```http
GET /api/categories/{category}/products
```

Authentication:

Optional.

Guest response:

```json
{
    "price_visible": false,
    "data": [
        {
            "id": 1,
            "category_id": 1,
            "name": "Royal Glory",
            "slug": "royal-glory",
            "image_url": "https://example.com/storage/products/image.jpg",
            "status": "in_stock",
            "is_top_product": true,
            "variants": [
                {
                    "id": 1,
                    "label": "A",
                    "size": "28"
                }
            ]
        }
    ],
    "meta": {
        "current_page": 1,
        "last_page": 3,
        "per_page": 20,
        "total": 60
    }
}
```

Logged-in user response:

```json
{
    "price_visible": true,
    "data": [
        {
            "id": 1,
            "category_id": 1,
            "name": "Royal Glory",
            "slug": "royal-glory",
            "image_url": "https://example.com/storage/products/image.jpg",
            "status": "in_stock",
            "is_top_product": true,
            "variants": [
                {
                    "id": 1,
                    "label": "A",
                    "size": "28",
                    "amount": 6880,
                    "final_price": 6536,
                    "discount_percent": 5
                }
            ]
        }
    ],
    "meta": {
        "current_page": 1,
        "last_page": 3,
        "per_page": 20,
        "total": 60
    }
}
```

Implementation notes:

- Use pagination.
- Load variants.
- If user is authenticated and approved, calculate final price using user discount.
- If guest, do not return `amount`, `discount_price`, or `final_price`.

### 3. Product Details API

Endpoint:

```http
GET /api/categories/{category}/products/{product}
```

Authentication:

Optional.

Behavior:

- Confirm product belongs to the category.
- Return 404 if product does not belong to category.
- Guests do not receive price fields.
- Logged-in approved users receive price fields.

Guest response:

```json
{
    "price_visible": false,
    "data": {
        "id": 1,
        "category_id": 1,
        "name": "Royal Glory",
        "slug": "royal-glory",
        "image_url": "https://example.com/storage/products/image.jpg",
        "description": "Product description",
        "status": "in_stock",
        "is_top_product": true,
        "variants": [
            {
                "id": 1,
                "label": "A",
                "size": "28"
            }
        ]
    }
}
```

Logged-in user response:

```json
{
    "price_visible": true,
    "data": {
        "id": 1,
        "category_id": 1,
        "name": "Royal Glory",
        "slug": "royal-glory",
        "image_url": "https://example.com/storage/products/image.jpg",
        "description": "Product description",
        "status": "in_stock",
        "is_top_product": true,
        "variants": [
            {
                "id": 1,
                "label": "A",
                "size": "28",
                "amount": 6880,
                "final_price": 6536,
                "discount_percent": 5
            }
        ]
    }
}
```

### 4. Contacts API

Endpoint:

```http
GET /api/contacts
```

Authentication:

Optional.

Response:

```json
{
    "data": [
        {
            "id": 1,
            "name": "Executive Name",
            "phone": "01700000000",
            "designation": "Sales Executive",
            "image_url": "https://example.com/storage/contacts/image.jpg"
        }
    ]
}
```

## Laravel Implementation Steps

### Step 1. Add API Catalog Controller

Create:

```text
app/Http/Controllers/Api/CatalogController.php
```

Methods:

- `categories()`
- `products(Category $category)`
- `product(Category $category, Product $product)`
- `contacts()`

### Step 2. Add Optional Mobile User Resolver

The catalog endpoints need to work for guests and authenticated users.

Option A:

- Use public routes.
- Read bearer token manually if present.
- Resolve user from Sanctum token.

Option B:

- Create middleware that allows optional Sanctum authentication.

Recommended simple approach:

- Use a helper method inside `CatalogController`.
- If request has a bearer token, try to resolve user.
- If valid user with role `user` and status `approved`, prices are visible.
- Otherwise, treat request as guest.

### Step 3. Add API Routes

In `routes/api.php`:

```php
use App\Http\Controllers\Api\CatalogController;

Route::get('/categories', [CatalogController::class, 'categories']);
Route::get('/categories/{category}/products', [CatalogController::class, 'products']);
Route::get('/categories/{category}/products/{product}', [CatalogController::class, 'product']);
Route::get('/contacts', [CatalogController::class, 'contacts']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
```

### Step 4. Update AuthController

Update API `login()`:

- Reject admin role.
- Reject pending, blocked, and rejected users.
- Check PIN.
- Enforce one-device login.
- Allow first-login device claim when `device_id` is empty.
- Allow one new-device claim only when `device_change_allowed` is true.
- Delete old Sanctum tokens when a new device is claimed.
- Turn `device_change_allowed` off after new device claim.
- Return discount.
- Return photo URL if possible.
- Return current `device_id`.

Add API `me()`:

- Return authenticated user profile.
- Reject non-user role.

### Step 5. Update Admin User Device Control

Admin user edit page must include:

- `Allow new device login` checkbox.

Behavior:

- When checked, `device_change_allowed` becomes true.
- The user's next correct mobile login can bind a new device.
- After that login, backend automatically sets `device_change_allowed` back to false.
- Existing `device_id` is replaced by the new submitted mobile device ID.

Admin user show page should display:

- Current `device_id`.
- Whether new device login is currently allowed.

### Step 6. Test API

Test these endpoints manually:

```http
GET /api
GET /api/health
POST /api/register
POST /api/login
GET /api/me
POST /api/logout
GET /api/categories
GET /api/categories/1/products
GET /api/categories/1/products/1
GET /api/contacts
```

Test guest catalog:

- No token.
- No price fields should exist.
- `price_visible` should be false.

Test logged-in catalog:

- Valid user token.
- Price fields should exist.
- `price_visible` should be true.

Test admin mobile login:

- Use admin credentials.
- API should return 403.

Test one-device login:

- Register with device A.
- Approve the user.
- Login with device A should work.
- Login with device B should fail with `Device not authorized`.
- In admin user edit, enable `Allow new device login`.
- Login with device B should work.
- Old tokens should be deleted.
- User should now be locked to device B.
- Login with device A should now fail.

## React Native Requirements

### Recommended Stack

Use Expo unless there is a strong reason for bare React Native.

Packages:

- Expo
- TypeScript
- React Navigation
- Axios
- Expo SecureStore
- TanStack Query
- Expo Image Picker
- Expo Application or Expo Device

Install example:

```bash
npx create-expo-app green-tech-mobile
cd green-tech-mobile
npm install axios @tanstack/react-query
npm install @react-navigation/native @react-navigation/native-stack @react-navigation/bottom-tabs
npx expo install react-native-screens react-native-safe-area-context expo-secure-store expo-application expo-image-picker
```

### Folder Structure

```text
src/
  api/
    client.ts
    auth.ts
    catalog.ts
  components/
    CategoryCard.tsx
    ProductCard.tsx
    VariantList.tsx
    StatusBadge.tsx
    PriceBlock.tsx
    AppButton.tsx
  navigation/
    AppNavigator.tsx
  screens/
    CategoriesScreen.tsx
    ProductsScreen.tsx
    ProductDetailsScreen.tsx
    LoginScreen.tsx
    SignupScreen.tsx
    ContactsScreen.tsx
    ProfileScreen.tsx
  storage/
    tokenStorage.ts
  types/
    api.ts
  utils/
    deviceId.ts
    formatPrice.ts
```

### Environment Config

Create:

```text
.env
```

Example:

```text
EXPO_PUBLIC_API_URL=https://your-domain.com/api
```

For local Android emulator:

```text
EXPO_PUBLIC_API_URL=http://10.0.2.2:8000/api
```

For physical phone on same Wi-Fi:

```text
EXPO_PUBLIC_API_URL=http://YOUR_COMPUTER_LAN_IP:8000/api
```

## React Native App Screens

### 1. Categories Screen

Route:

```text
CategoriesScreen
```

API:

```http
GET /api/categories
```

UI:

- Header with app name/logo.
- Grid/list of categories.
- Category image.
- Category name.
- Tap category to go to products.

Guest and logged-in users both see this screen.

### 2. Products Screen

Route:

```text
ProductsScreen(categoryId)
```

API:

```http
GET /api/categories/{category}/products
```

UI:

- Back button.
- Category name.
- Product cards.
- Product image.
- Product model/name.
- Variant labels and sizes.
- Stock status.
- If guest: show `Login for price details`.
- If logged in: show discounted prices.

### 3. Product Details Screen

Route:

```text
ProductDetailsScreen(categoryId, productId)
```

API:

```http
GET /api/categories/{category}/products/{product}
```

UI:

- Back button.
- Product image.
- Product model/name.
- Variants.
- Stock status.
- Description if available.
- If guest: show `Login for price details`.
- If logged in: show discounted prices.
- WhatsApp button: `Chat With Us`.

### 4. Login Screen

Route:

```text
LoginScreen
```

API:

```http
POST /api/login
```

Fields:

- Phone
- PIN

Hidden/generated:

- Device ID

UI:

- Phone input.
- PIN input.
- Sign In button.
- Sign Up link.
- Continue as guest link.

After login:

- Store token.
- Store user.
- Redirect to categories.
- Refetch product data so prices appear.

### 5. Signup Screen

Route:

```text
SignupScreen
```

API:

```http
POST /api/register
```

Fields:

- Name
- Phone
- Shop name
- City/area
- Photo optional
- PIN
- Confirm PIN

Hidden/generated:

- Device ID

After successful registration:

- Show message: `Registration submitted successfully. Please wait for admin approval.`
- Redirect to login.

### 6. Contacts Screen

Route:

```text
ContactsScreen
```

API:

```http
GET /api/contacts
```

UI:

- Contact/executive list.
- Name.
- Phone.
- Designation.
- Call button.
- WhatsApp button.

### 7. Profile Screen

Visible only when logged in.

UI:

- Name.
- Phone.
- Shop name.
- City/area.
- Discount.
- Logout button.

API:

```http
GET /api/me
POST /api/logout
```

## Mobile Auth State

Use SecureStore for token:

```text
tokenStorage.ts
```

Functions:

- `saveToken(token)`
- `getToken()`
- `removeToken()`

Axios should attach token automatically:

```ts
Authorization: Bearer token
```

If token is missing:

- Catalog APIs still work.
- Prices stay hidden.

If token exists:

- Catalog APIs return price data.

If token expires or API returns 401:

- Remove token.
- Treat user as guest.

## Price Visibility Rule

The mobile UI must follow `price_visible` from the API.

If `price_visible` is false:

```text
Login for price details
```

If `price_visible` is true:

Show variant final prices.

Never calculate guest prices in the mobile app.

## Device ID Requirement

Current backend uses `device_id`.

Registration:

- Generate device ID.
- Send it to `/api/register`.
- Backend stores it.
- This becomes the only allowed mobile device for that user.

Login:

- Send same device ID.
- Backend compares it with user device ID.
- If user has no saved device ID, the first correct login claims the device.
- If user has a different saved device ID, login is blocked unless admin has allowed a new device login.

If device ID does not match:

```json
{
    "message": "Device not authorized"
}
```

Admin new-device flow:

1. Customer contacts admin manually.
2. Admin opens the user edit page.
3. Admin enables `Allow new device login`.
4. User logs in from the new phone with correct phone and PIN.
5. Backend deletes old mobile tokens.
6. Backend replaces old `device_id` with the new device ID.
7. Backend turns `device_change_allowed` off again.
8. User is now locked to the new device.

One-device rule:

- A user can have only one active allowed mobile device.
- Registration locks the first registered device.
- Admin-created users have no device at first, so the first correct mobile login claims the device.
- New device login does not work unless admin allows it first.

Implementation note:

- Expo device IDs can change depending on platform and app reinstall.
- If customers change phone often, keep the admin manual approval flow or later add an in-app device change request flow.

## API Testing Checklist

### Guest

- Can call `/api/categories`.
- Can call `/api/categories/{category}/products`.
- Can call `/api/categories/{category}/products/{product}`.
- Can call `/api/contacts`.
- Cannot see `amount`.
- Cannot see `final_price`.
- Sees `price_visible: false`.

### Approved User

- Can login.
- Can call `/api/me`.
- Can see prices.
- Sees `price_visible: true`.
- Prices include user discount.
- Can logout.

### Pending User

- Cannot login.
- Receives pending message.

### Blocked User

- Cannot login.
- Receives blocked message.

### Rejected User

- Cannot login.
- Receives rejected message.

### Admin User

- Cannot login to mobile API.
- Receives 403 message.

## Release Steps

### Backend

1. Run migrations.
2. Seed dummy data if needed.
3. Test API locally.
4. Deploy backend.
5. Set correct `APP_URL`.
6. Ensure storage link works:

```bash
php artisan storage:link
```

7. Confirm image URLs work from phone browser.

### Mobile

1. Set production API URL.
2. Test guest browsing.
3. Test registration.
4. Approve user from web admin.
5. Test login.
6. Test price visibility.
7. Test logout.
8. Test on real Android phone.
9. Test on real iPhone if needed.
10. Build release.

## Future Features

Optional later improvements:

- Device change request from mobile app.
- Push notifications for new products.
- Product search.
- Favorite products.
- WhatsApp message prefilled with product name/model.
- App version check.
- Offline category/product cache.
- Admin approval push notification.
