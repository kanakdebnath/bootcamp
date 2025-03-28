// Create the elements
const heroBannerContent = document.querySelector(".course-countdown");
console.log();
const countdownHTML = ` 
  <div class="clock">
    <div id="day" class="label-count">
      <div id="day1" class="count">00</div>
      <div id="day-label" class="label">DAYS</div>
    </div>
    <div class="label-count">
      <div id="hour" class="count">00</div>
      <div id="hour-label" class="label">HOURS</div>
    </div>
    <div class="label-count">
      <div id="minute" class="count">00</div>
      <div id="minute-label" class="label">MINUTES</div>
    </div>
    <div class="label-count">
      <div id="second" class="count">00</div>
      <div id="second-label" class="label">SECONDS</div>
    </div>
  </div>
`;

if (heroBannerContent) {
  // Prepend the countdownHTML to the heroBannerContent
  heroBannerContent.insertAdjacentHTML("afterbegin", countdownHTML);

  function countdown() {
    const now = new Date();
    const xmasDate = new Date("Mar 10, 2025 00:00");
    //const xmasDate = new Date("Nov 22, 2021 00:00");
    const currTime = now.getTime();
    const xmasTime = xmasDate.getTime();
    let diffTime = xmasTime - currTime;

    let sec = Math.floor(diffTime / 1000);
    let min = Math.floor(sec / 60);
    let hr = Math.floor(min / 60);
    const realDay = Math.floor(hr / 24);

    hr %= 24;
    min %= 60;
    sec %= 60;

    hr = hr < 10 ? "0" + hr : hr;
    min = min < 10 ? "0" + min : min;
    sec = sec < 10 ? "0" + sec : sec;

    document.getElementById("day1").textContent = realDay;
    document.getElementById("hour").textContent = hr;
    document.getElementById("minute").textContent = min;
    document.getElementById("second").textContent = sec;

    setTimeout(countdown, 1000);
  }

  countdown();
}

// js for mobile sidebar

function w3_open() {
  const mySidebar = document.getElementById("mySidebar");
  mySidebar.style.left = "0";
  mySidebar.style.visibility = "visible";
}

function w3_close() {
  const mySidebar = document.getElementById("mySidebar");
  mySidebar.style.left = "-100%";
  mySidebar.style.visibility = "hidden";
}
