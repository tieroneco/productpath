window.fbAsyncInit = function () {
    FB.init({
        appId: '894426757275452',
        cookie: true,
        xfbml: true,
        version: 'v2.8'
    });
    FB.AppEvents.logPageView();
};

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

window.FBregisterWithProduct = function () {
    var s = this;
    FB.getLoginStatus(function (r) {
        if (r.authResponse) {
            getFbDetails(function (r) {
                $('#register-form #registerform-email').val(r.email).attr('readonly', true);
                $('#register-form #registerform-password').val(r.id).closest('.form-group').hide()
                $('#register-form #registerform-confirmpassword').val(r.id).closest('.form-group').hide();
                $('#register-form').append('<input type="hidden" name="social" value="FB">');
                if (typeof r.first_name == 'string') {
                    $('#register-form').append('<input type="hidden" name="_firstname" value="' + r.first_name + ' ' + r.last_name + '">');
                }
            })
        } else {
            FB.login(FBregisterWithProduct, {scope: 'publish_actions,public_profile,email', });
        }
    });
}

window.FeatureTrackFBLogin = function () {
    FB.getLoginStatus(function (response) {
        FBstatusChangeCallback(response);
    });
}

window.getFbDetails = function (callback) {
    FB.api('/me', {fields: 'first_name,last_name,email'}, function (r) {
        callback(r);
    });
}
window.FBAjaxLogin = function (data) {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    data['_csrf'] = csrfToken;
    jQuery.ajax({
        url: '/site/fb-login',
        data: data,
        type: 'post',
        dataType: 'json',
        success: function (r) {
            if (r) {
                window.location.href = r;
            } else if (r == 0) {
                $('.login-head h2').text('Can\'t Authenticate');
            }

        },
        error: function (r) {
            $('.login-head h2').text('Can\'t Authenticate');
        },
        complete: function () {
            console.log('complete');
        }
    })
}
function FBstatusChangeCallback(response, callback) {
    if (response.authResponse) {

        FB.api('/me', {fields: 'last_name,email'}, function (r) {

            if (callback) {
                callback(r);
            } else {
                FBAjaxLogin({
                    email: r.email,
                    id: r.id,
                    type: 'facebook'
                })
            }

        });
    } else {
        FB.login(FBstatusChangeCallback, {scope: 'publish_actions,public_profile,email', });
    }
}

// + facebook share idea
// + facebook share idea
$(document).ready(function () {
    setTimeout(function () {
//1954837168125830
        $('[fbid]').click(function () {

            var id = $(this).attr('fbid');
            FB.getLoginStatus(function (response) {

                FBstatusChangeCallback(response, function (r) {


                    var t = window.location.href;
                    t = t.replace(/\d+$/, id);

                    FB.ui({
                        method: 'share',
                        href: t
                    }, function (response) {
                        console.log(response)
                    });
                });
            });
        });
     $(document).on('click', '[twi]', function(){
        var id = $(this).attr('twi');
        
     });
     if($('[twi]').length){
      var t = window.location.href;      
                    t = t.replace(/\d+$/,$(this).attr['twi']);
                    console.log($('[twi]')[0]);
                    console.log(window.twttr);
      window.twttr.widgets.createShareButton('/',
        $('[twi]')[0],
        {
          url:t,
          text:'Please check',
          size:'large'
        });
     }
    }, 1000);

})

// +++++++++++++++++ Twitter  
window.twttr = (function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {};
    if (d.getElementById(id))
        return t;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js, fjs);

    t._e = [];
    t.ready = function (f) {
        t._e.push(f);
        twttr.events.bind('tweet', tweetIntentToAnalytics);
    };

    return t;
}(document, "script", "twitter-wjs"));
function tweetIntentToAnalytics(r){
  console.log(r);
}
