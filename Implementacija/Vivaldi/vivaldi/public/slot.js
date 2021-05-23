/**
 * jQuery Slot Machine by Stefan Petre.
 * http://www.eyecon.ro/slotmachine/
 *
 * Modified.
 */

(function($){

    var slotMachine = function(){

        var spinning = 3,
            spin = [0,0,0],

            startSlot = function(){

                spinning = false;

                $('#slot-trigger').removeClass('slot-triggerDisabled');

                this.blur();

                return false;

            },
            spin = function(){

                this.blur();

                if(spinning == false){

                    $('#slot-machine .arm').animate({ top: '45px', height: '2%' });
                    $('#slot-machine .arm .knob').animate({ top: '-20px', height: '20px' });
                    $('#slot-machine .arm-shadow').animate({ top: '40px' }, 380);
                    $('#slot-machine .ring1 .shadow, #slot-machine .ring2 .shadow').animate({ top: '50%', opacity: 1 });

                    spinning = 3;

                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            res = this.responseText.split(",");
                            setTimeout(function(){
                                document.getElementById("ukupno_tokena").innerHTML = res[3];
                            }, 3000);
                            //document.getElementById("ukupno_tokena").innerHTML = res[3];
                            document.getElementById("brojevi").innerHTML =res[0] + " " + res[1] + " " + res[2];
                            this.responseText;

                            spin[0] = parseInt(res[0]);
                            spin[1] = parseInt(res[1]);
                            spin[2] = parseInt(res[2]);

                            $('#slot-trigger').addClass('slot-triggerDisabled');

                            $('img.slotSpinAnimation').show();

                            $('#wheel1 img:first').css('top', - (spin[0] * 44 + 16) + 'px');
                            $('#wheel2 img:first').css('top', - (spin[1] * 44 + 16) + 'px');
                            $('#wheel3 img:first').css('top', - (spin[2] * 44 + 16) + 'px');

                            setTimeout(function(){
                                $('#slot-machine .arm').animate({ top: '-25px', height: '50%', overflow: 'visible' });
                                $('#slot-machine .arm .knob').animate({ top: '-15px', height: '16px' });
                                $('#slot-machine .arm-shadow').animate({ top: '13px' });
                                $('#slot-machine .ring1 .shadow, #slot-machine .ring2 .shadow').animate({ top: '0', opacity: 0 });
                            }, 500);

                            setTimeout(function(){
                                stopSpin(1);
                            }, 1500 + parseInt(1500 * Math.random()));

                            setTimeout(function(){
                                stopSpin(2);
                            }, 1500 + parseInt(1500 * Math.random()));

                            setTimeout(function(){
                                stopSpin(3);
                            }, 1500 + parseInt(1500 * Math.random()));



                        }
                    };
                    xhttp.open("POST", "http://localhost:8080/Korisnik/spin" , true);
                    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    var params = 'Tokeni='+document.getElementById("ulozeni_tokeni").innerHTML;
                    document.getElementById("ulozeni_tokeni").innerHTML = 0;
                    xhttp.send(params);
                }

                return false;

            },
            stopSpin = function(slot){

                $('#wheel' + slot)
                    .find('img:last')
                    .hide()
                    .end()
                    .find('img:first')
                    .animate({
                        top: - spin[slot - 1] * 44
                    },{
                        duration: 500,
                        easing: 'elasticOut',
                        complete: function() {

                            spinning --;
                        }
                    });
            };
            
        return {

            init: function(){

                startSlot();

                $('#slot-trigger')
                    .bind('mousedown', function(){
                        $(this).addClass('slot-triggerDown');
                    })
                    .bind('click', spin);

                $(document).bind('mouseup', function(){
                    $('#slot-trigger').removeClass('slot-triggerDown');
                });

                $('#wheel1 img:first').css('top', - (parseInt(Math.random() * 8) * 44) + 'px');
                $('#wheel2 img:first').css('top', - (parseInt(Math.random() * 8) * 44) + 'px');
                $('#wheel3 img:first').css('top', - (parseInt(Math.random() * 8) * 44) + 'px');

            }

        };
    }();

    $.extend($.easing,{
        bounceOut: function (x, t, b, c, d){
            if((t/=d) < (1/2.75)){
                return c*(7.5625*t*t) + b;
            } else if(t < (2/2.75)){
                return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
            } else if(t < (2.5/2.75)){
                return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
            } else {
                return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
            }
        },
        easeOut: function (x, t, b, c, d){
            return -c *(t/=d)*(t-2) + b;
        },
        elasticOut: function (x, t, b, c, d) {
            var s=1.70158;var p=0;var a=c;
            if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
            if (a < Math.abs(c)) { a=c; var s=p/4; }
            else var s = p/(2*Math.PI) * Math.asin (c/a);
            return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
        }
    });

    $(document).ready(slotMachine.init);

})(jQuery);

function blink(element){

    element.animate({ opacity: 0 }, 200, 'linear', function(){
        $(this).animate({ opacity: 1 }, 200);
    });

}