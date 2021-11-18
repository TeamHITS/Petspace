<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
<script>

    var firebaseConfig = {
        apiKey: "AIzaSyCoq99epR64V3LQ-ou1r7k38yh5mc5Y3Ps",
        authDomain: "need-a-bin.firebaseapp.com",
        projectId: "need-a-bin",
        storageBucket: "need-a-bin.appspot.com",
        messagingSenderId: "418344105532",
        appId: "1:418344105532:web:cba75bcbadbcb76c20f539",
        measurementId: "G-4MRBHV8MMS"
    };

    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
    window.fcmMessaging = messaging;


    function initFirebaseMessagingRegistration() {
        messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function (token) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route("save-token") }}',
                    type: 'POST',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        console.log('Token saved successfully.');
                    },
                    error: function (err) {
                        console.log('User device Token Error' + err);
                    },
                });

            }).catch(function (err) {
            console.log('User device Token Error' + err);
        });
    }

    messaging.onMessage(function (payload) {
        console.log({payload});
        getNotifications();
        // playNotification()

        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
            sound: "default"
        };
        new Notification(noteTitle, noteOptions);
    });
    window.getNewToken = function (data) {
        messaging.getToken()
            .then(function (token) {

                console.log("hellobd");
                console.log({token});

                // subscribeTopics(token);
            })
            .catch(function (err) {
                console.log('An error occurred while retrieving token. ', err);
            });
    }

    function playNotification() {
        var audio = new Audio("{{asset('/sounds/mixkit-modern-classic-door-bell-sound-113.wav')}}");
        audio.play();
    }

    initFirebaseMessagingRegistration();

    let permission = Notification.permission;

    if (permission === "granted") {
        showNotification();
    } else if (permission === "default") {
        requestAndShowPermission();
    } else {
        alert("Notification permission is Disable.\n \n You'll have to check your browser settings and unblock the site.");
        requestAndShowPermission();
    }

    function requestAndShowPermission() {
        Notification.requestPermission(function (permission) {
            if (permission === "granted") {
                showNotification();
            }
        });
    }

    function showNotification() {
        //  if(document.visibilityState === "visible") {
        //      return;
        //  }
        console.log("notification permission enabled")
        // let title = "I love Educative.io";
        // let icon = 'https://homepages.cae.wisc.edu/~ece533/images/zelda.png'; //this is a large image may take more time to show notifiction, replace with small size icon
        // let body = "Message to be displayed";
        // let notification = new Notification(title, { body, icon });
        // notification.onclick = () => {
        //         notification.close();
        //         window.parent.focus();
        // }
    }

</script>
