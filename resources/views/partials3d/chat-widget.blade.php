<div class="chat-widget" data-chat-widget>
    <div class="chat-widget__panel" id="chat-widget-panel" role="dialog" aria-label="e-Trust AI chat" hidden data-chat-panel>
        @include('partials3d.chatbox', ['variant' => 'widget'])
    </div>
    <button type="button" class="chat-fab" aria-expanded="false" aria-controls="chat-widget-panel" data-chat-open>
        <span class="chat-fab__icon" aria-hidden="true"><svg class="icon"><use href="#i-chat"/></svg></span>
        <span class="chat-fab__text">Ask e-Trust AI</span>
    </button>
</div>
