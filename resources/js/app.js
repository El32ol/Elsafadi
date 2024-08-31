import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.Echo.private(`App.Models.User.${userID}`)
    .notification(function(data) {
      
        $('#notificationsList').prepend(`<div class="dropdown-divider">
      <a href="${data.url}?noty=${data.id }" class="dropdown-item">
        
        <strong> * </strong>
         
        <span class="notification-text">${data.body}</span>
        </a>
    </div>`)
        let count = Number($('#newCount').text())
            count++;
            if(count > 99)
            {
                count = '99+';
            }
        $('#newCount').text(count)
    })

// window.Echo.private(`App.Models.User.${userId}`)
//     .notification(function(data) {
//         if (data.body) {
//             alert(data.body);
//         } else {
//             console.error('No body found in notification data');
//         }
//     });

window.Echo.join(`messages.${userID}`)
    .listen('.message.created' , function(data){
        alert(data.message.message)
    })
    window.Echo.join('presence-messages1')
    .listen('App\\Events\\MessageCreated', function(data) {
        console.log('Event received');
        console.log(JSON.stringify(data, null, 2));
        if (data && data.message && data.message.message) {
            alert(data.message.message);
        } else {
            console.log('Message format is unexpected');
        }
    });


    