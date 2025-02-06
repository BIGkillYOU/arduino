/*  clock */
const hours = document.querySelector('.hours');
const minutes = document.querySelector('.minutes');
const seconds = document.querySelector('.seconds');

/*  play button */
const play = document.querySelector('.play');
const pause = document.querySelector('.pause');
const playBtn = document.querySelector('.circle__btn');
const wave1 = document.querySelector('.circle__back-1');
const wave2 = document.querySelector('.circle__back-2');

/*  rate slider */
const container = document.querySelector('.slider__box');
const btn = document.querySelector('.slider__btn');
const color = document.querySelector('.slider__color');
const tooltip = document.querySelector('.slider__tooltip');

document.addEventListener('DOMContentLoaded', (event) => {
  const themeToggleButton = document.getElementById('theme-toggle');
  const secondaryButton = document.querySelector('.btn__secondary');

  themeToggleButton.addEventListener('click', () => {
      document.body.classList.toggle('dark-theme');
  });

  secondaryButton.addEventListener('click', () => {
      secondaryButton.classList.toggle('dark-theme');
  });
});

document.getElementById('theme-toggle').addEventListener('click', function() {
  // หารูปภาพทั้งหมดที่มี class 'chip__icon'
  const icons = document.querySelectorAll('.chip__icon img');

  // เปลี่ยนแหล่งที่มาของภาพเป็น iot2.png และ humidity2.png
  icons.forEach(function(icon) {
      if (icon.src.includes('iot.png') || icon.src.includes('humidity.png') || icon.src.includes('diskette.png')){
          icon.src = icon.src.includes('iot.png') ? '../dist/image/iot2.png' : icon.src;
          icon.src = icon.src.includes('humidity.png') ? '../dist/image/humidity2.png' : icon.src;
          icon.src = icon.src.includes('diskette.png') ? '../dist/image/diskette2.png' : icon.src;
      } else {
          icon.src = icon.src.includes('iot2.png') ? '../dist/image/iot.png' : icon.src;
          icon.src = icon.src.includes('humidity2.png') ? '../dist/image/humidity.png' : icon.src;
          icon.src = icon.src.includes('diskette2.png') ? '../dist/image/diskette.png' : icon.src;
      }
  });
});

clock = () => {
  let today = new Date();
  let h = (today.getHours() % 12) + today.getMinutes() / 59; // 22 % 12 = 10pm
  let m = today.getMinutes(); // 0 - 59
  let s = today.getSeconds(); // 0 - 59

  h *= 30; // 12 * 30 = 360deg
  m *= 6;
  s *= 6; // 60 * 6 = 360deg

  rotation(hours, h);
  rotation(minutes, m);
  rotation(seconds, s);

  // call every second
  setTimeout(clock, 500);
}

rotation = (target, val) => {
  target.style.transform =  `rotate(${val}deg)`;
}

window.onload = clock();

dragElement = (target, btn) => {
  target.addEventListener('mousedown', (e) => {
      onMouseMove(e);
      window.addEventListener('mousemove', onMouseMove);
      window.addEventListener('mouseup', onMouseUp);
  });

  onMouseMove = (e) => {
      e.preventDefault();
      let targetRect = target.getBoundingClientRect();
      let x = e.pageX - targetRect.left + 10;
      if (x > targetRect.width) { x = targetRect.width};
      if (x < 0){ x = 0};
      btn.x = x - 10;
      btn.style.left = btn.x + 'px';

      // get the position of the button inside the container (%)
      let percentPosition = (btn.x + 10) / targetRect.width * 100;
      
      // color width = position of button (%)
      color.style.width = percentPosition + "%";

      // move the tooltip when button moves, and show the tooltip
      tooltip.style.left = btn.x - 5 + 'px';
      tooltip.style.opacity = 1;

      // show the percentage in the tooltip
      tooltip.textContent = Math.round(percentPosition) + '%';
  };

  onMouseUp  = (e) => {
      window.removeEventListener('mousemove', onMouseMove);
      tooltip.style.opacity = 0;

      btn.addEventListener('mouseover', function() {
        tooltip.style.opacity = 1;
      });
      
      btn.addEventListener('mouseout', function() {
        tooltip.style.opacity = 0;
      });
  };
};

dragElement(container, btn);

/*  play button  */
playBtn.addEventListener('click', function(e) {
  e.preventDefault();
  pause.classList.toggle('visibility');
  play.classList.toggle('visibility');
  playBtn.classList.toggle('shadow');
  wave1.classList.toggle('paused');
  wave2.classList.toggle('paused');
});
document.addEventListener('DOMContentLoaded', () => {
    const textToType = "The quick brown fox jumps over the lazy dog.";
    const textToTypeElement = document.getElementById('textToType');
    const inputArea = document.getElementById('inputArea');
    const startButton = document.getElementById('startButton');
    const resetButton = document.getElementById('resetButton');
    const clock = document.getElementById('clock');
    let timer;
    let startTime;

    textToTypeElement.innerText = textToType;

    startButton.addEventListener('click', () => {
        startTime = new Date().getTime();
        timer = setInterval(updateClock, 1000);
        inputArea.disabled = false;
        inputArea.focus();
        startButton.disabled = true;
    });

    resetButton.addEventListener('click', () => {
        clearInterval(timer);
        inputArea.value = "";
        inputArea.disabled = true;
        startButton.disabled = false;
        resetClock();
    });

    inputArea.addEventListener('input', () => {
        if (inputArea.value === textToType) {
            clearInterval(timer);
            alert(`Congratulations! You completed the typing game in ${(new Date().getTime() - startTime) / 1000} seconds.`);
        }
    });

    function updateClock() {
        const now = new Date().getTime();
        const elapsedTime = Math.floor((now - startTime) / 1000);
        const hours = Math.floor(elapsedTime / 3600);
        const minutes = Math.floor((elapsedTime % 3600) / 60);
        const seconds = elapsedTime % 60;
        document.getElementById('hours').style.transform = `rotate(${hours * 30}deg)`;
        document.getElementById('minutes').style.transform = `rotate(${minutes * 6}deg)`;
        document.getElementById('seconds').style.transform = `rotate(${seconds * 6}deg)`;
    }

    function resetClock() {
        document.getElementById('hours').style.transform = 'rotate(0deg)';
        document.getElementById('minutes').style.transform = 'rotate(0deg)';
        document.getElementById('seconds').style.transform = 'rotate(0deg)';
    }
});
