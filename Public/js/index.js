$(document).ready(function(){
    var $a = $('#events-switchs a'), timer = 0;
    $a.click(function(){
        if(this.className.length === 0) {
            $('#events-switchs a').removeClass('focus');
            $('.event-detail').hide();
            $(this).addClass('focus');
            $('#event-'+this.innerHTML).show();
        }
        return false;
    }).mouseover(function(){
        clearInterval(timer);    
    }).mouseout(function(){
        timer = eventLoop($a);    
    });
    
    timer = eventLoop($a);
});

function eventLoop($a){
    var count = 1;
    return setInterval(function(){
        $a[count++%3].click();
    }, 2222);
}