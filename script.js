

$(document).ready(()=>{
    let header = document.getElementById('header');
    let card1btn = document.getElementById('card1btn');
    let invisible = document.getElementById('invisible');
    let card1 = document.getElementById('card1');
    let headerH3 = document.querySelector('header div h3');
    let openIcon = document.getElementById('open-icon');
    let closeIcon = document.getElementById('close-icon');
    let mobMenu = document.getElementById('mob-menu');
    let i = 0;
    let colors = ['var(--c5)','var(--c2)','var(--c6)']
    header.style.backgroundImage = "url(images/headers/" +i+ ".jpg)";
    function changeHeaderBg(){
        if (i<2) i++; else i=0;
        let name = "url(images/headers/" +i+ ".webp)";
        //console.log(name)
        header.style.backgroundImage = name;
        headerH3.style.color = colors[i]
        

    }
    setInterval(changeHeaderBg, 5000);

    openIcon.addEventListener('click', ()=>{
        mobMenu.style.transform = 'translateX(0)'
    });
    closeIcon.addEventListener('click', ()=>{
        mobMenu.style.transform = 'translateX(-120%)'
    })

    $('#invisible').fadeOut(300);
    let isOpen = false;
    card1btn.addEventListener('click', () => {
        let h1;
        let h2;
        if(document.body.clientWidth >720) {
            h1 = 400;
            h2 = 1140;
        } else {
            h1 = 660;
            h2 = 1740;
        }
        if (isOpen) {
            isOpen = false;
            card1btn.innerHTML = 'Подробнее';
            $('#card1').animate({height: h1},200);
            $('#invisible').fadeOut(300);
            //card1.style.height = '400px';
            //invisible.style.display = 'flex';
            //invisible.style.opacity = 0;
            invisible.style.transform = 'translateY(-80px)';
            //card1.style.animation = 'open 0.5s 1 reverse';
            
        } else {
            isOpen = true;
            card1btn.innerHTML = 'Свернуть';
            $('#card1').animate({height: h2},200);
            //card1.style.animation = 'open 0.5s 1 forwards';
            //card1.style.height = 'max-content';
            //invisible.style.display = 'flex';
            setTimeout(()=>{
              $('#invisible').fadeIn(300);
            //invisible.style.opacity = 1;
            invisible.style.transform = 'translateY(0)';
            }, 300)
            
            
        }
        
    })
    document.addEventListener('scroll', (e)=>{
        //console.log(window.scrollY, header.clientHeight)
        if (window.scrollY>header.clientHeight) {
            $('#toTop').fadeIn(500);
        } else {
            $('#toTop').fadeOut(500);
        }
    })
    $("#menu").on("click","a", function (event) {
        let k =0;/*
        if (body.clientWidth>1300) {
            k = 200
        } else if (body.clientWidth>1200) {
            k = 100
        } else if (body.clientWidth>1000) {
            k = 50
        } else if (body.clientWidth>820) {
            k = 0
        } else k=-80*/
        //k=body.clientWidth*0.08-80
		event.preventDefault();
		let id  = $(this).attr('href'),
		top = $(id).offset().top;
		$('body,html').animate({scrollTop: top+k}, 1000);
        
	});
    $(".icons").on("click","span", function (event) {
        let k =-60;
        //console.log($(this))
		event.preventDefault();
		let id  = $(this).attr('name');
        console.log(id)
		let top = $(id).offset().top;
		$('body,html').animate({scrollTop: top+k}, 1000);
        
	});
    $(".price-card").on("click","span", ()=> {
        let k =0;
        //console.log($(this))
		
		let top = $('#contact').offset().top;
		$('body,html').animate({scrollTop: top+k}, 1000);
        
	});
    $('#toTop').on('click', ()=>{
        $('body,html').animate({scrollTop: 0}, 1000);
        
    })
    $("#mob-menu").on("click","a", function (event) {
        let k =0;
         if (document.body.clientWidth>720) {
            k = 0
        } else k=-20
        //k=body.clientWidth*0.08-80
		event.preventDefault();
		let id  = $(this).attr('href'),
		top = $(id).offset().top;
		$('body,html').animate({scrollTop: top+k}, 1000);
        setTimeout(()=>{
            mobMenu.style.transform = 'translateX(-120%)'
        }, 1000)
        //$('#toTop').fadeIn(500);
	});

/*
    $('.small-card').on('mouseover', ()=>{
        $('.small-card-content').animate({height: 550}, 100);
        $('.small-card-content').css({background: 'rgba(0, 0, 0, 0.8)'}, 200);
    })
    $('.small-card').on('mouseout', ()=>{
        $('.small-card-content').animate({height: 360}, 100);
        $('.small-card-content').css({background: 'linear-gradient(190deg, transparent 30%, rgba(0, 0, 0, 1) 30%)'}, 200);
    })
    */
})
