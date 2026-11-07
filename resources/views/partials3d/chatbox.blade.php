{{-- Reusable AI chat panel. $variant: widget | page --}}
@php
    $variant = $variant ?? 'page';
    $aiModels = app(\App\Services\AiAssistant::class)->available();
@endphp
<div class="chatbox chatbox--{{ $variant }}" data-chat data-endpoint="{{ url('/api/chat') }}">
    <div class="chatbox__head">
        <span class="chatbox__avatar" aria-hidden="true"><svg class="icon"><use href="#i-spark"/></svg></span>
        <div class="chatbox__id">
            <strong>e-Trust AI</strong>
            <span class="chatbox__status"><span class="live-dot" aria-hidden="true"></span>Free, in Bangla or English</span>
        </div>
        <button type="button" class="icon-btn" data-chat-reset title="Start a new chat">
            <svg class="icon" aria-hidden="true"><use href="#i-refresh"/></svg><span class="sr-only">Start a new chat</span>
        </button>
        @if ($variant === 'widget')
            <a href="{{ url('/assistant') }}" class="icon-btn" title="Open full screen">
                <svg class="icon" aria-hidden="true"><use href="#i-arrow-up-right"/></svg><span class="sr-only">Open full screen</span>
            </a>
            <button type="button" class="icon-btn" data-chat-close title="Close chat">
                <svg class="icon" aria-hidden="true"><use href="#i-close"/></svg><span class="sr-only">Close chat</span>
            </button>
        @endif
    </div>

    <div class="chatbox__log" data-chat-log role="log" aria-live="polite" aria-label="Conversation with e-Trust AI"></div>

    <div class="chatbox__suggest" data-chat-suggest>
        <button type="button" data-prompt="What services does e-Trust offer?">What services do you offer?</button>
        <button type="button" data-prompt="DORKARI কী? এতে কী কী টুল আছে?" lang="bn">DORKARI কী?</button>
        <button type="button" data-prompt="Write a short Facebook post to promote my clothing shop's Eid sale.">Write a Facebook post for my shop</button>
        <button type="button" data-prompt="আমার ছোট ব্যবসার জন্য ওয়েবসাইট কেন দরকার?" lang="bn">ব্যবসার জন্য ওয়েবসাইট কেন দরকার?</button>
        @if ($variant === 'page')
            <button type="button" data-prompt="How can I keep my Facebook and email accounts safe from hackers?">Keep my accounts safe</button>
            <button type="button" data-prompt="Explain what an API is, in simple words, with an example.">Explain an API simply</button>
        @endif
    </div>

    @if (count($aiModels) > 1)
        <div class="chatbox__model">
            <label for="chat-model-{{ $variant }}">Answer with</label>
            <select id="chat-model-{{ $variant }}" data-chat-model>
                <option value="">Auto (best available)</option>
                @foreach ($aiModels as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
    @endif

    <form class="chatbox__form" data-chat-form>
        <label class="sr-only" for="chat-input-{{ $variant }}">Your message</label>
        <textarea id="chat-input-{{ $variant }}" rows="1" maxlength="2000" placeholder="Ask anything, in Bangla or English" data-chat-input></textarea>
        <button type="submit" class="chatbox__send" data-chat-send>
            <svg class="icon" aria-hidden="true"><use href="#i-send"/></svg><span class="sr-only">Send</span>
        </button>
    </form>
    <p class="chatbox__note">e-Trust AI is new and can make mistakes. Please check important information.</p>
</div>
