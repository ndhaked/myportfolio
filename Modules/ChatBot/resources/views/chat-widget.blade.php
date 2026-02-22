<div id="chatbot-widget" class="chatbot-widget">
    <!-- Chat Button -->
    <div id="chatbot-button" class="chatbot-button">
        <i class="fa fa-comments"></i>
    </div>

    <!-- Chat Window -->
    <div id="chatbot-window" class="chatbot-window" style="display: none;">
        <div class="chatbot-header">
            <div class="chatbot-title">
                <div class="main-title">
                    <div class="chatbot-status-dot"></div>
                    AI Assistant
                </div>
                <div class="sub-title">Online | Expert Support</div>
            </div>
            <div id="chatbot-close" class="chatbot-close">
                <i class="fa fa-close"></i>
            </div>
        </div>
        
        <div id="chatbot-messages" class="chatbot-messages">
            <div class="chatbot-message bot">
                <div class="message-content">Hello! I'm Nirbhay's AI assistant. How can I help you regarding his **Laravel expertise** or **projects** today?
                </div>
            </div>
        </div>

        <div class="chatbot-input-area">
            <div class="chatbot-input-wrapper">
                <input type="text" id="chatbot-input" placeholder="Type your message..." autocomplete="off">
            </div>
            <button id="chatbot-send">
                <i class="fa fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

<!-- Google Fonts for Premium UI -->
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    .chatbot-widget {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 10000;
        font-family: 'Outfit', sans-serif;
    }

    .chatbot-button {
        width: 65px;
        height: 65px;
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 28px;
        cursor: pointer;
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .chatbot-button:hover {
        transform: scale(1.1) rotate(10deg);
        box-shadow: 0 15px 30px rgba(99, 102, 241, 0.6);
    }

    .chatbot-window {
        position: absolute;
        bottom: 85px;
        right: 0;
        width: 380px;
        height: 550px;
        max-height: calc(100vh - 120px); /* Ensure it doesn't go off-top */
        background: #ffffff;
        border-radius: 24px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transform-origin: bottom right;
        transition: all 0.4s ease;
    }

    .chatbot-header {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        padding: 12px 20px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
    }

    .chatbot-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 40px;
        background: linear-gradient(to top, rgba(0,0,0,0.05), transparent);
        pointer-events: none;
    }

    .chatbot-title {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .chatbot-title .main-title {
        font-weight: 700;
        font-size: 18px;
        letter-spacing: -0.02em;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .chatbot-title .sub-title {
        font-size: 12px;
        opacity: 0.9;
    }

    .chatbot-status-dot {
        width: 10px;
        height: 10px;
        background: #22c55e;
        border-radius: 50%;
        border: 2px solid white;
    }

    .chatbot-close {
        width: 32px;
        height: 32px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s;
    }

    .chatbot-close:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .chatbot-messages {
        flex: 1;
        padding: 24px 20px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 20px;
        background: #fdfdff;
        scroll-behavior: smooth;
    }

    /* Scrollbar */
    .chatbot-messages::-webkit-scrollbar {
        width: 5px;
    }
    .chatbot-messages::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }

    .chatbot-message {
        max-width: 88%;
        padding: 14px 18px;
        border-radius: 18px;
        font-size: 14.5px;
        line-height: 1.6;
        position: relative;
        animation: slideUp 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        word-wrap: break-word;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px) scale(0.95); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    .chatbot-message.bot {
        align-self: flex-start;
        background: #f1f5f9;
        color: #1e293b;
        border-bottom-left-radius: 4px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .chatbot-message.user {
        align-self: flex-end;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        border-bottom-right-radius: 4px;
        box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
    }

    .chat-link {
        display: inline-block;
        margin-top: 8px;
        padding: 8px 16px;
        background: #6366f1;
        color: white !important;
        border-radius: 12px;
        text-decoration: none !important;
        font-weight: 600;
        transition: all 0.2s;
        box-shadow: 0 4px 10px rgba(99, 102, 241, 0.2);
    }

    .chat-link:hover {
        background: #4f46e5;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(99, 102, 241, 0.3);
    }

    .chatbot-message b, .chatbot-message strong {
        font-weight: 700;
        color: inherit;
    }

    .chat-image-wrapper {
        margin-top: 12px;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        transition: transform 0.3s;
    }

    .chat-image-wrapper:hover {
        transform: scale(1.02);
    }

    .chat-inline-image {
        width: 100%;
        display: block;
        cursor: pointer;
    }

    .image-caption {
        padding: 8px;
        font-size: 11px;
        text-align: center;
        color: #64748b;
        background: white;
        border-top: 1px solid #f1f5f9;
    }

    /* Interactive Timeline */
    .chat-timeline {
        margin: 15px 0;
        padding-left: 15px;
        border-left: 2px dashed #e2e8f0;
        position: relative;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 20px;
        padding-left: 20px;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-dot {
        position: absolute;
        left: -22px;
        top: 4px;
        width: 12px;
        height: 12px;
        background: #6366f1;
        border-radius: 50%;
        border: 2px solid white;
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
    }

    .timeline-content {
        background: #f8fafc;
        padding: 10px 14px;
        border-radius: 12px;
        font-size: 13px;
        border: 1px solid #f1f5f9;
        transition: all 0.3s ease;
    }

    .timeline-content:hover {
        background: white;
        transform: translateX(5px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        border-color: #6366f1;
    }

    .timeline-content strong {
        color: #1e293b;
        display: block;
        margin-bottom: 2px;
    }

    .timeline-content small {
        color: #64748b;
        font-weight: 500;
    }

    .chatbot-input-area {
        padding: 20px;
        background: white;
        border-top: 1px solid #f1f5f9;
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .chatbot-input-wrapper {
        flex: 1;
        position: relative;
    }

    #chatbot-input {
        width: 100%;
        border: 1px solid #e2e8f0;
        padding: 12px 18px;
        border-radius: 30px;
        outline: none;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    #chatbot-input:focus {
        border-color: #6366f1;
        background: white;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    #chatbot-send {
        background: #6366f1;
        color: white;
        border: none;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    #chatbot-send:hover {
        background: #4f46e5;
        transform: scale(1.1) rotate(-5deg);
    }

    #chatbot-send i {
        font-size: 18px;
        margin-left: 2px;
    }

    /* Mobile Responsiveness */
    @media (max-width: 480px) {
        .chatbot-widget {
            bottom: 20px;
            right: 20px;
        }
        .chatbot-window {
            width: calc(100vw - 40px);
            height: calc(100vh - 100px);
            bottom: 75px;
        }
        .chatbot-button {
            width: 55px;
            height: 55px;
            font-size: 24px;
        }
    }

    /* Typing indicator */
    .typing {
        display: flex;
        gap: 5px;
        padding: 5px 0;
    }

    .typing span {
        width: 7px;
        height: 7px;
        background: #94a3b8;
        border-radius: 50%;
        animation: typingBounce 1.4s infinite ease-in-out both;
    }

    .typing span:nth-child(1) { animation-delay: -0.32s; }
    .typing span:nth-child(2) { animation-delay: -0.16s; }

    @keyframes typingBounce {
        0%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-7px); }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const botBtn = document.getElementById('chatbot-button');
        const botWin = document.getElementById('chatbot-window');
        const botClose = document.getElementById('chatbot-close');
        const botInput = document.getElementById('chatbot-input');
        const botSend = document.getElementById('chatbot-send');
        const botMessages = document.getElementById('chatbot-messages');

        // Markdown-like formatter
        function formatText(text) {
            if (!text) return '';
            
            // Clean up text
            let formatted = text.trim();
            
            // Handle Bold (**text**)
            formatted = formatted.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
            
            // Handle Images (![text](url)) - Added support
            formatted = formatted.replace(/!\[([^\]]*)\]\(([^)]+)\)/g, function(match, alt, url) {
                return '<div class="chat-image-wrapper"><a href="' + url.trim() + '" download><img src="' + url.trim() + '" alt="' + alt + '" class="chat-inline-image"></a><div class="image-caption">Click to download</div></div>';
            });
            
            // Handle Links ([text](url)) - More robust regex
            formatted = formatted.replace(/\[([^\]]+)\]\(([^)]+)\)/g, function(match, label, url) {
                return '<a href="' + url.trim() + '" target="_blank" class="chat-link">' + label.trim() + '</a>';
            });
            
            // Handle lists (- item)
            formatted = formatted.replace(/^\s*-\s+(.*)$/gm, '• $1');
            
            // Handle newlines
            formatted = formatted.replace(/\n/g, '<br>');
            
            return formatted;
        }

        // Toggle Chat Window
        botBtn.addEventListener('click', () => {
            if (botWin.style.display === 'none') {
                botWin.style.display = 'flex';
                if (typeof gsap !== 'undefined') {
                    gsap.fromTo(botWin, 
                        { scale: 0.5, opacity: 0, y: 50, x: 20 }, 
                        { scale: 1, opacity: 1, y: 0, x: 0, duration: 0.5, ease: "expo.out" }
                    );
                }
                botInput.focus();
            } else {
                closeChat();
            }
        });

        botClose.addEventListener('click', closeChat);

        function closeChat() {
            if (typeof gsap !== 'undefined') {
                gsap.to(botWin, { 
                    scale: 0.8, 
                    opacity: 0, 
                    y: 30,
                    duration: 0.3, 
                    ease: "power2.in",
                    onComplete: () => botWin.style.display = 'none'
                });
            } else {
                botWin.style.display = 'none';
            }
        }

        // Send Message
        function sendMessage() {
            const message = botInput.value.trim();
            if (!message) return;

            addMessage(message, 'user');
            botInput.value = '';

            const typingId = showTyping();

            fetch('{{ route("chatbot.message") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ message: message })
            })
            .then(response => response.json())
            .then(data => {
                removeTyping(typingId);
                addMessage(data.message, 'bot');
            })
            .catch(error => {
                console.error('Error:', error);
                removeTyping(typingId);
                addMessage('I encountered a slight technical glitch. Let\'s try that again!', 'bot');
            });
        }

        botSend.addEventListener('click', sendMessage);
        botInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendMessage();
        });

        function addMessage(text, side) {
            const msgDiv = document.createElement('div');
            msgDiv.className = `chatbot-message ${side}`;
            msgDiv.innerHTML = `<div class="message-content">${side === 'bot' ? formatText(text) : text}</div>`;
            botMessages.appendChild(msgDiv);
            
            // Auto scroll
            botMessages.scrollTo({
                top: botMessages.scrollHeight,
                behavior: 'smooth'
            });
        }

        function showTyping() {
            const typingDiv = document.createElement('div');
            typingDiv.className = 'chatbot-message bot typing-indicator';
            typingDiv.innerHTML = '<div class="typing"><span></span><span></span><span></span></div>';
            botMessages.appendChild(typingDiv);
            botMessages.scrollTop = botMessages.scrollHeight;
            return typingDiv;
        }

        function removeTyping(el) {
            if (el && el.parentNode) {
                el.parentNode.removeChild(el);
            }
        }

        // Initialize welcome message with formatting
        const firstMsg = botMessages.querySelector('.message-content');
        if (firstMsg) {
            firstMsg.innerHTML = formatText(firstMsg.innerText);
        }
    });
</script>
