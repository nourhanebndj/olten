<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages - Olten</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
      integrity="sha512-pVZ0/UomqzLv+Jw5s6pzR5hT+AAUz8Wv44m9X/nr2P81ZPd5f2iRFPZT+5Tb6LhZQ9Q1yH8QDsW0QJ0Gp7aO2g==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/style_connecter/style_connected.css') }}">
</head>
<body>
<div class="connected-layout">
    
    {{-- SIDEBAR --}}
    @include('components.sidebar_connected')
    
    <div class="main-content">
        {{-- HEADER --}}
        @include('components.header_connected')
        
        {{-- CONTENU PRINCIPAL --}}
        <main class="dashboard-content">
            <div class="page-header">
                <div class="breadcrumb">
                    <a href="#">Accueil</a> > <span>Tableau de bord</span>
                </div>
                <h1 class="page-title">Messages</h1>
            </div>

            <div class="messages-layout">
                <!-- Liste des messages -->
                <div class="messages-container">
                    <h2 class="section-title">Boîte de réception</h2>
                    <div class="messages-list" id="messagesList">
                        <!-- Messages générés par JavaScript -->
                    </div>
                </div>

                <!-- Détail de la conversation -->
                <div class="conversation-detail" id="conversationDetail">
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fa-solid fa-comments"></i>
                        </div>
                        <h3>Sélectionnez une conversation</h3>
                        <p>Choisissez un message dans la liste pour voir les détails</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    //Messages 
// ===================================
// DONNÉES STATIQUES DES CONVERSATIONS
// ===================================
const conversationsData = {
    1: {
        id: 1,
        sender: 'Mark Deffit',
        avatar: 'https://i.pravatar.cc/150?img=12',
        badge: 'Pas de référence',
        lastMessage: 'yo^^',
        time: '1 semaine',
        messages: [
            {
                id: 1,
                sender: 'Mark Deffit',
                text: 'Bonjour ! Comment allez-vous ?',
                time: 'Il y a 1 semaine',
                sent: false
            },
            {
                id: 2,
                sender: 'Vous',
                text: 'Salut Mark ! Je vais bien, merci. Et toi ?',
                time: 'Il y a 1 semaine',
                sent: true
            },
            {
                id: 3,
                sender: 'Mark Deffit',
                text: 'yo^^',
                time: 'Il y a 1 semaine',
                sent: false
            }
        ]
    },
    2: {
        id: 2,
        sender: 'Jovany Benz',
        avatar: 'https://i.pravatar.cc/150?img=33',
        badge: 'Pas de référence',
        lastMessage: 'Merci pour votre inscription djo ^^',
        time: '1 semaine',
        messages: [
            {
                id: 1,
                sender: 'Vous',
                text: 'Bonjour, je viens de m\'inscrire sur la plateforme',
                time: 'Il y a 1 semaine',
                sent: true
            },
            {
                id: 2,
                sender: 'Jovany Benz',
                text: 'Merci pour votre inscription djo ^^',
                time: 'Il y a 1 semaine',
                sent: false
            },
            {
                id: 3,
                sender: 'Jovany Benz',
                text: 'N\'hésitez pas si vous avez des questions !',
                time: 'Il y a 1 semaine',
                sent: false
            }
        ]
    },
    3: {
        id: 3,
        sender: 'aicha difallah',
        avatar: 'https://i.pravatar.cc/150?img=45',
        badge: 'Pas de référence',
        lastMessage: 'Bonjour avez vous reçu votre paiement?',
        time: '1 semaine',
        messages: [
            {
                id: 1,
                sender: 'aicha difallah',
                text: 'Bonjour avez vous reçu votre paiement?',
                time: 'Il y a 1 semaine',
                sent: false
            },
            {
                id: 2,
                sender: 'Vous',
                text: 'Bonjour Aicha, je vérifie et je reviens vers vous',
                time: 'Il y a 1 semaine',
                sent: true
            },
            {
                id: 3,
                sender: 'aicha difallah',
                text: 'Merci beaucoup pour votre retour rapide',
                time: 'Il y a 1 semaine',
                sent: false
            }
        ]
    }
};

// ===================================
// CHARGER LA LISTE DES MESSAGES
// ===================================
function loadMessagesList() {
    const messagesList = document.getElementById('messagesList');
    
    if (!messagesList) {
        console.error('Element #messagesList not found');
        return;
    }
    
    messagesList.innerHTML = '';

    Object.values(conversationsData).forEach(conv => {
        const messageCard = document.createElement('div');
        messageCard.className = 'message-card';
        messageCard.dataset.id = conv.id;
        
        messageCard.innerHTML = `
            <div class="message-avatar">
                <img src="${conv.avatar}" alt="${conv.sender}">
            </div>
            <div class="message-content">
                <div class="message-header">
                    <h3 class="message-sender">${conv.sender}</h3>
                    <span class="message-time">${conv.time}</span>
                </div>
                <span class="message-badge">${conv.badge}</span>
                <p class="message-text">
                    <i class="fa-solid fa-reply"></i> ${conv.lastMessage}
                </p>
            </div>
        `;
        
        messageCard.addEventListener('click', () => showConversation(conv.id));
        messagesList.appendChild(messageCard);
    });
}

// ===================================
// AFFICHER LES DÉTAILS D'UNE CONVERSATION
// ===================================
function showConversation(id) {
    const conv = conversationsData[id];
    const detail = document.getElementById('conversationDetail');
    
    if (!conv || !detail) {
        console.error('Conversation or detail element not found');
        return;
    }
    
    // Mettre à jour la classe active
    document.querySelectorAll('.message-card').forEach(card => {
        card.classList.remove('active');
    });
    
    const activeCard = document.querySelector(`.message-card[data-id="${id}"]`);
    if (activeCard) {
        activeCard.classList.add('active');
    }

    // Construire les messages
    const messagesHtml = conv.messages.map(msg => `
        <div class="chat-message ${msg.sent ? 'sent' : ''}">
            <div class="chat-avatar">
                <img src="${msg.sent ? 'https://i.pravatar.cc/150?img=68' : conv.avatar}" alt="${msg.sender}">
            </div>
            <div class="chat-bubble">
                <div class="chat-name">${msg.sender}</div>
                <div class="chat-text">${msg.text}</div>
                <div class="chat-time">${msg.time}</div>
            </div>
        </div>
    `).join('');

    // Construire le HTML complet de la conversation
    detail.innerHTML = `
        <div class="conversation-header">
            <div class="conversation-user">
                <div class="conversation-user-avatar">
                    <img src="${conv.avatar}" alt="${conv.sender}">
                </div>
                <div class="conversation-user-info">
                    <h3>${conv.sender}</h3>
                    <p>${conv.badge}</p>
                </div>
            </div>
            <div class="conversation-actions">
                <button class="btn-action" id="hideConversationBtn">
                    <i class="fa-solid fa-times"></i> Masquer
                </button>
            </div>
        </div>
        <div class="conversation-messages" id="conversationMessages">
            ${messagesHtml}
        </div>
        <div class="conversation-input">
            <div class="input-group">
                <button class="btn-attach" id="attachFileBtn">
                    <i class="fa-solid fa-paperclip"></i>
                </button>
                <textarea id="messageInput" placeholder="Votre message..."></textarea>
                <button class="btn-send" id="sendMessageBtn">
                    Envoyer un message
                </button>
            </div>
        </div>
    `;

    detail.classList.add('active');

    // Ajouter l'événement au bouton Masquer
    const hideBtn = document.getElementById('hideConversationBtn');
    if (hideBtn) {
        hideBtn.addEventListener('click', hideConversation);
    }

    // Ajouter l'événement au bouton Envoyer
    const sendBtn = document.getElementById('sendMessageBtn');
    const messageInput = document.getElementById('messageInput');
    
    if (sendBtn && messageInput) {
        sendBtn.addEventListener('click', () => sendMessage(id));
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage(id);
            }
        });
    }

    // Scroll vers le bas des messages
    scrollToBottom();
}

// ===================================
// MASQUER LA CONVERSATION
// ===================================
function hideConversation() {
    const detail = document.getElementById('conversationDetail');
    
    if (!detail) return;
    
    detail.classList.remove('active');
    
    // Remettre l'état vide
    detail.innerHTML = `
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fa-solid fa-comments"></i>
            </div>
            <h3>Sélectionnez une conversation</h3>
            <p>Choisissez un message dans la liste pour voir les détails</p>
        </div>
    `;
    
    // Retirer la classe active de tous les messages
    document.querySelectorAll('.message-card').forEach(card => {
        card.classList.remove('active');
    });
}

// ===================================
// ENVOYER UN MESSAGE
// ===================================
function sendMessage(conversationId) {
    const messageInput = document.getElementById('messageInput');
    
    if (!messageInput) return;
    
    const messageText = messageInput.value.trim();
    
    if (messageText === '') {
        return;
    }
    
    // Ajouter le message à la conversation
    const conv = conversationsData[conversationId];
    
    if (!conv) return;
    
    const newMessage = {
        id: conv.messages.length + 1,
        sender: 'Vous',
        text: messageText,
        time: 'À l\'instant',
        sent: true
    };
    
    conv.messages.push(newMessage);
    
    // Mettre à jour le dernier message dans la liste
    conv.lastMessage = messageText;
    
    // Rafraîchir l'affichage
    showConversation(conversationId);
    
    // Vider le champ de saisie
    const newInput = document.getElementById('messageInput');
    if (newInput) {
        newInput.value = '';
        newInput.focus();
    }
}

// ===================================
// SCROLL VERS LE BAS
// ===================================
function scrollToBottom() {
    setTimeout(() => {
        const messagesContainer = document.getElementById('conversationMessages');
        if (messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    }, 100);
}

// ===================================
// INITIALISATION
// ===================================
document.addEventListener('DOMContentLoaded', function() {
    console.log('Messages app initialized');
    loadMessagesList();
});

// Rendre les fonctions globales pour le debugging
window.messagesApp = {
    conversationsData,
    loadMessagesList,
    showConversation,
    hideConversation,
    sendMessage
};
</script>
</body>
</html>