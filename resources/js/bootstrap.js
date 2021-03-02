window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });


function myTrim(x) {
    return x.replace(/^\s+|\s+$/gm,'');
  }
  
  function Clear() {
    document.getElementById('choosenAccount').value = '';
    document.getElementById('account_id').value = null;
  
    document.getElementById('choosenOffer').value = '';
    document.getElementById('offer_id').value = null;
  }
  
  // Account modal
  function addAccount(id) {
    var account = document.getElementById('account'+id).textContent;
    document.getElementById('choosenAccount').value = myTrim(account);
  
    var accountId = document.getElementById('accountId'+id).textContent;
    document.getElementById('account_id').value = parseInt(accountId);
  }
  
  function addOffer(id) {
    var offer = document.getElementById('offer'+id).textContent;
    document.getElementById('choosenOffer').value = offer;
  
    var offerId = document.getElementById('offerId'+id).textContent;
    document.getElementById('offer_id').value = parseInt(offerId);
  }
  
  // Offer modal
  
  function modalAccount(id){
    var modal = document.getElementById("myModalAc"+id);
    modal.style.display = "block";
  }
  
  function closeAccountModal(id){
    var modal = document.getElementById("myModalAc"+id);
    modal.style.display = "none";
  }
  
  function closeModal(id){
    var modal = document.getElementById("myModalAc"+id);
    modal.style.display = "none";
  }
  
  // When the user clicks anywhere outside of the modal, close it
  // window.onclick = function(event) {
  //   var modal = document.getElementsByClassName("modal")[0];
  //   if (event.target == modal) {
  //     // var modal = document.getElementById("myModal"+id);
      
  //     modal.style.display = "none";
  //   }
 
