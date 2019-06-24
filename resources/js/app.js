/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// Window.tsort = reuie("./tablesorter");

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
  el: '#app',
  updated(){
    console.log('update');
  }
});

$(document).ready(function(){
        //bootstrap modal
      $('#booking, #rebooking').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var modal = $(this)
          // modal.find('.modal-title').text('Бронирование  id:' + recipient)
          modal.find('.modal-body input:hidden[name=pc_id]').val(recipient)
          modal.find('.modal-body input:hidden[name=orgtech_id]').val(recipient)
          $(this).find('[autofocus]').focus();
      })

        //ip detect
      $(function() {   
          console.log('ip detect loaded') 
        // NOTE: window.RTCPeerConnection is "not a constructor" in FF22/23
        var RTCPeerConnection = /*window.RTCPeerConnection ||*/ window.webkitRTCPeerConnection || window.mozRTCPeerConnection;

        if (RTCPeerConnection) (function () {
          var rtc = new RTCPeerConnection({iceServers:[]});
          if (1 || window.mozRTCPeerConnection) {      // FF [and now Chrome!] needs a channel/stream to proceed
              rtc.createDataChannel('', {reliable:false});
          };

          rtc.onicecandidate = function (evt) {
              // convert the candidate to SDP so we can run it through our general parser
              // see https://twitter.com/lancestout/status/525796175425720320 for details
              if (evt.candidate) grepSDP("a="+evt.candidate.candidate);
          };
          rtc.createOffer(function (offerDesc) {
              grepSDP(offerDesc.sdp);
              rtc.setLocalDescription(offerDesc);
          }, function (e) { console.warn("offer failed", e); });


          var addrs = Object.create(null);
          addrs["0.0.0.0"] = false;
          function updateDisplay(newAddr) {
              if (newAddr in addrs) return;
              else addrs[newAddr] = true;
              var displayAddrs = Object.keys(addrs).filter(function (k) { return addrs[k]; });
              if(document.getElementById('hidden_ip_buy') && document.getElementById('hidden_ip_rebuy')){
                document.getElementById('hidden_ip_buy').value = displayAddrs.join(" or perhaps ") || "n/a";
                document.getElementById('hidden_ip_rebuy').value = displayAddrs.join(" or perhaps ") || "n/a";
              }
          }

            function grepSDP(sdp) {
                var hosts = [];
                sdp.split('\r\n').forEach(function (line) { // c.f. http://tools.ietf.org/html/rfc4566#page-39
                    if (~line.indexOf("a=candidate")) {     // http://tools.ietf.org/html/rfc4566#section-5.13
                        var parts = line.split(' '),        // http://tools.ietf.org/html/rfc5245#section-15.1
                            addr = parts[4],
                            type = parts[7];
                        if (type === 'host') updateDisplay(addr);
                    } else if (~line.indexOf("c=")) {       // http://tools.ietf.org/html/rfc4566#section-5.7
                        var parts = line.split(' '),
                            addr = parts[2];
                        updateDisplay(addr);
                    }
                });
            }
        })(); 
      });


    // $("#tablePreview").tablesorter({
    //     theme : "bootstrap",
    //     widthFixed: false,
    //     sortReset : true,
    //     headerTemplate : '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!
    //     widgets : [ "uitheme", "filter", "columns", "zebra" ],
    //     widgetOptions : {
    //         zebra : ["even", "odd"],
    //         columns: [ "primary", "secondary", "tertiary" ],
    //         filter_reset : ".reset",
    //         filter_cssFilter: "form-control",
    //     }
    // });

    
});