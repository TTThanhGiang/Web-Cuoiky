{{-- -------------------- Saved Messages -------------------- --}}
@if($get == 'saved')
    <table class="messenger-list-item" data-contact="{{ Auth::user()->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
            <div class="saved-messages avatar av-m">
                <span class="far fa-bookmark"></span>
            </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ Auth::user()->id }}" data-type="user">Saved Messages <span>You</span></p>
                <span>Save messages secretly</span>
            </td>
        </tr>
    </table>
@endif

{{-- -------------------- Contact list -------------------- --}}
{{-- -------------------- Contact list -------------------- --}}
@if($get == 'users')
    {{-- Nếu là admin --}}
    @if(auth()->user()->id == 1)
        @foreach(App\Models\User::where('id', '!=', 1)->get() as $user)
            <table class="messenger-list-item" data-contact="{{ $user->id }}">
                <tr data-action="0">
                    {{-- Avatar side --}}
                    <td style="position: relative">
                        @if($user->active_status)
                            <span class="activeStatus"></span>
                        @endif
                        <div class="avatar av-m"
                        style="background-image: url('{{ $user->avatar }}');">
                        </div>
                    </td>
                    {{-- center side --}}
                    <td>
                        <p data-id="{{ $user->id }}" data-type="user">
                            {{ strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name }}
                        </p>
                        <span>
                            Chat with this user
                        </span>
                    </td>
                </tr>
            </table>
        @endforeach
    @else
        {{-- Nếu không phải admin, chỉ hiển thị admin --}}
        <table class="messenger-list-item" data-contact="1"> <!-- Chỉ admin có id=1 -->
            <tr data-action="0">
                {{-- Avatar side --}}
                <td style="position: relative">
                    <div class="avatar av-m"></div>
                </td>
                {{-- center side --}}
                <td>
                    <p data-id="1" data-type="user">
                        Admin
                    </p>
                    <span>Start chatting with Admin</span>
                </td>
            </tr>
        </table>
    @endif
@endif


{{-- -------------------- Search Item -------------------- --}}
@if($get == 'search_item')
<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td>
        <div class="avatar av-m"
        style="background-image: url('{{ $user->avatar }}');">
        </div>
        </td>
        {{-- center side --}}
        <td>
            <p data-id="{{ $user->id }}" data-type="user">
            {{ strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name }}
        </td>

    </tr>
</table>
@endif

{{-- -------------------- Shared photos Item -------------------- --}}
@if($get == 'sharedPhoto')
<div class="shared-photo chat-image" style="background-image: url('{{ $image }}')"></div>
@endif


