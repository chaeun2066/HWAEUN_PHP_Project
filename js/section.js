function call_ad(){
  let slideshowSlides = document.querySelector('.slideshowSlides');
  let slides = document.querySelectorAll('.slideshowSlides a');
  let currentIndex = 0;
  let timer = "";
  let slidesCount = slides.length;

  let prev = document.querySelector('.prev');
  let next = document.querySelector('.next');

  let indicators = document.querySelectorAll('.indicator a');

  for(let i = 0; i < slidesCount; i++){
    let newLeft = i * 100 + '%';
    slides[i].style.left = newLeft;
  }

  function gotoSlide(index){
    currentIndex = index;
    let newLeft = index * -100 + '%';
    slideshowSlides.style.left = newLeft;
    indicators.forEach((obj) => {
      obj.classList.remove('active');
    });
    indicators[index].classList.add('active');
  }

  gotoSlide(0);

  function startTimer(){
    timer = setInterval(function(){
      let nextIndex = (currentIndex + 1) % slidesCount;
      gotoSlide(nextIndex);
    }, 3500);
  }

  startTimer();

  slideshowSlides.addEventListener('mouseenter', ()=>{
    clearInterval(timer);
  });

  slideshowSlides.addEventListener('mouseleave', ()=>{
    startTimer();
  });

  prev.addEventListener('mouseenter',()=>{
    clearInterval(timer);
  })

  next.addEventListener('mouseenter',()=>{
    clearInterval(timer);
  })

  prev.addEventListener('click',(e)=>{
    e.preventDefault();
    currentIndex = currentIndex - 1;
    if(currentIndex < 0){
      currentIndex = 2;
    }
    gotoSlide(currentIndex);
  })

  next.addEventListener('click',(e)=>{
    e.preventDefault();
    currentIndex = currentIndex + 1;
    if(currentIndex > 2){
      currentIndex = 0;
    }
    gotoSlide(currentIndex);
  })

  indicators.forEach((obj)=>{
    obj.addEventListener('mouseenter', ()=>{
      clearInterval(timer);
    });
  });

  for(let i = 0; i < indicators.length; i++){
    indicators[i].addEventListener('click', (e)=>{
      e.preventDefault();
      gotoSlide(i);
    });
  }
}