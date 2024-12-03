@include('Chatify::layouts.headLinks')
<div class="messenger">
    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="messenger-listView {{ !!$user ? 'conversation-active' : '' }}">
        {{-- Header and search bar --}}
        <div class="m-header">
            <nav>
                <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">MESSAGES</span> </a>
            </nav>
        </div>

        {{-- Contact List --}}
        <div class="m-body contacts-container">
            {{-- Contact --}}
            <p class="messenger-title"><span>Admin</span></p>
            <div class="listOfContacts" style="width: 100%; height: calc(100% - 272px); position: relative;">
                <a href="{{ route('chatify.chat', ['id' => 1]) }}" class="contact-item">
                    <div class="avatar av-s"></div>
                    <div class="contact-info">
                        <p class="contact-name">Admin</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- ----------------------Messaging side---------------------- --}}
    <div class="messenger-messagingView">
        {{-- Header title [conversation name] and buttons --}}
        <div class="m-header m-header-messaging">
            <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                <div class="avatar av-s header-avatar"></div>
                <a href="#" class="user-name">{{ $user->name }}</a>
            </div>
        </div>

        {{-- Messaging area --}}
        <div class="m-body messages-container app-scroll">
            {{-- Chat messages --}}
            <div class="messages">
                <p class="message-hint center-el"><span>Please select a chat to start messaging</span></p>
            </div>
        </div>

        {{-- Send Message Form --}}
        <form method="POST" action="{{ route('chatify.sendMessage', ['id' => $user->id]) }}">
            @csrf
            <textarea name="message" class="m-send app-scroll" placeholder="Type a message.."></textarea>
            <button type="submit" class="send-button"><span class="fas fa-paper-plane"></span></button>
        </form>
    </div>
</div>

@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')
