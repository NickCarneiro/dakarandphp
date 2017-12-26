PHP Implementation of Dan Kaminsky's Defcon RNG Challenge
https://gist.github.com/PaulCapestany/6148566

    
    function millis()         { return Date.now(); }
    function flip_coin()      { n=0; then = millis()+1; while(millis()<=then) { n=!n; } return n; }
    function get_fair_bit()   { while(1) { a=flip_coin(); if(a!=flip_coin()) { return(a); } } }
    function get_random_byte(){ n=0; bits=8; while(bits--){ n<<=1; n|=get_fair_bit(); } return n; }

I picked up a copy of `PoC || GTFO` from Barnes and Noble and this snippet was in there.

Pretty neat. This is much faster than the JavaScript implementation because we can a microseconds wall clock instead of millis.

# Further Reading
https://dankaminsky.com/2012/08/15/dakarand/
https://www.finnie.org/2012/08/14/twuewand-2-0-released/