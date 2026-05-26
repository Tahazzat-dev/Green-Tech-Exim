@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Mobile Terminal Users</h1>
    <p class="text-sm text-gray-500">Manage user authorization and unlock system device links.</p>
</div>

<div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Shop Details</th>
                <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Location</th>
                <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Device Footprint</th>
                <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3.5 class text-right text-xs font-semibold text-gray-500 uppercase pr-8">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            @foreach($users as $user)
            <tr>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=80&h=80&q=80' }}" class="w-10 h-10 rounded-full object-cover border border-gray-200" alt="Avatar">
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                            <div class="text-xs text-gray-500">{{ $user->phone }} | <span class="text-gray-700 font-semibold">{{ $user->shop_name }}</span></div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">
                    {{ $user->city_area }}
                </td>
                <td class="px-6 py-4 text-sm font-mono text-xs text-gray-500">
                    @if($user->device_id)
                        <span class="bg-gray-100 px-2 py-1 rounded border border-gray-200 block max-w-[160px] truncate">{{ $user->device_id }}</span>
                    @else
                        <span class="text-amber-500 font-sans italic">No active device linked</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                        {{ $user->status === 'approved' ? 'bg-emerald-50 text-emerald-700' : ($user->status === 'pending' ? 'bg-amber-50 text-amber-700' : 'bg-rose-50 text-rose-700') }}">
                        {{ ucfirst($user->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right space-y-1 whitespace-nowrap pr-8">
                    <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST" class="inline-block">
                        @csrf @method('PATCH')
                        @if($user->status !== 'approved')
                            <button type="submit" name="status" value="approved" class="text-xs bg-emerald-600 text-white px-2.5 py-1 rounded-lg hover:bg-emerald-700 transition">Approve</button>
                        @endif
                        @if($user->status !== 'disabled' && $user->status !== 'pending')
                            <button type="submit" name="status" value="disabled" class="text-xs bg-gray-100 text-gray-700 px-2.5 py-1 rounded-lg hover:bg-gray-200 transition">Disable</button>
                        @endif
                    </form>

                    @if($user->device_id)
                        <form action="{{ route('admin.users.resetDevice', $user->id) }}" method="POST" class="inline-block">
                            @csrf @method('PATCH')
                            <button type="submit" class="text-xs border border-rose-200 text-rose-600 bg-rose-50 px-2.5 py-1 rounded-lg hover:bg-rose-100 transition" onclick="return confirm('Resetting will clear device locks and set user state to pending. Continue?')">Reset Device</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4 border-t border-gray-100">
        {{ $users->links() }}
    </div>
</div>
@endsection