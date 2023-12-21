<style>
  *, *:before, *:after {
    box-sizing: border-box;
  }

  body {
    background: #2f3349;
    padding: 20px;
  }

  .scene {
    width: 202px;
    height: 380px;
    /* background: #2f3349; */
    -webkit-animation: vibration 0.2s infinite;
            animation: vibration 0.2s infinite;
    /* position: absolute; */
    margin: auto;
    top: 0;
    left: -100px;
    right: 0;
    bottom: 0;
  }

  .wing-left {
    position: absolute;
    z-index: 10;
    height: 103px;
    width: 0px;
    padding: 0px;
    top: 82px;
    left: 16px;
    transform: rotate(10deg) skew(5deg);
    border-top: 21px solid transparent;
    border-right: 38px solid #743388;
    border-bottom: 19px solid transparent;
  }
  .wing-left:after {
    content: "";
    display: block;
    position: absolute;
    bottom: -50px;
    height: 0px;
    width: 0px;
    border-top: 20px solid transparent;
    border-right: 50px solid #2f3349;
    border-bottom: 50px solid transparent;
  }

  .wing-right {
    position: absolute;
    z-index: 10;
    height: 103px;
    width: 0px;
    padding: 0px;
    top: 62px;
    right: 17px;
    transform: rotate(-10deg) skew(-5deg);
    border-top: 0 solid transparent;
    border-right: 40px solid #743388;
    border-bottom: 15px solid transparent;
  }
  .wing-right:after {
    content: "";
    display: block;
    position: absolute;
    top: -33px;
    left: -19px;
    height: 0px;
    width: 0px;
    border-top: 36px solid transparent;
    border-right: 68px solid #2f3349;
    border-bottom: 45px solid transparent;
  }

  .exhaust {
    position: absolute;
    z-index: 20;
    top: 156px;
    left: 51px;
    height: 0px;
    width: 101px;
    border-top: 23px solid #743388;
    border-left: 9px solid transparent;
    border-right: 8px solid transparent;
  }

  .capsule {
    position: absolute;
    z-index: 30;
    background: #2f3349;
    left: 46px;
    top: 5px;
    width: 111px;
    height: 156px;
    opacity: 1;
    overflow: hidden;
  }
  .capsule .base {
    position: absolute;
    background: #ccc;
    width: 112px;
    height: 94px;
    top: 62px;
    left: 0px;
    background: linear-gradient(to right, #F3F3F3 0%, #F3F3F3 65%, #E0E0E0 65%, #E0E0E0 100%);
  }
  .capsule .top {
    position: absolute;
    height: 0px;
    width: 0px;
    padding: 0px;
    left: 0;
    border-left: 56px solid transparent;
    border-right: 56px solid transparent;
    border-bottom: 62px solid #F3F3F3;
  }
  .capsule .top:after {
    content: "";
    position: absolute;
    height: 0px;
    width: 0px;
    border-left: 0px solid transparent;
    border-right: 156px solid transparent;
    border-bottom: 84px solid #2f3349;
    transform: skew(42deg);
    top: -14px;
    left: 25px;
    z-index: 50;
  }
  .capsule .top .shadow {
    position: absolute;
    height: 0px;
    width: 0px;
    border-left: 20px solid transparent;
    border-right: 80px solid transparent;
    border-bottom: 90px solid #E0E0E0;
    transform: skew(26deg);
    top: -20px;
    left: -3px;
    z-index: 40;
    box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0) !important;
  }

  .window-big {
    width: 70px;
    height: 70px;
    background: #743388;
    border-radius: 8em;
    position: absolute;
    z-index: 40;
    top: 57px;
    left: 66px;
  }

  .window-small {
    width: 44px;
    height: 44px;
    background: #272425;
    border-radius: 8em;
    position: absolute;
    z-index: 50;
    top: 70px;
    left: 79px;
  }

  .propulsed__slow, .fire-4, .fire-3, .fire-2 {
    -webkit-animation: fire_propulsion 0.3s ease-in infinite;
            animation: fire_propulsion 0.3s ease-in infinite;
  }

  .main_fire, .fire-1 {
    -webkit-animation: main_fire 0.1s cubic-bezier(0.175, 0.885, 0.42, 1.41) infinite;
            animation: main_fire 0.1s cubic-bezier(0.175, 0.885, 0.42, 1.41) infinite;
  }

  .fire-1 {
    position: absolute;
    height: 70px;
    width: 70px;
    top: 169px;
    transform-origin: 50% 50%;
    transform: rotate(-40deg) skew(1deg, -11deg);
    z-index: 10;
    left: 64px;
    background: linear-gradient(135deg, #EF8B32 0%, #EF8B32 50%, #E82134 50%, #E82134 100%);
  }

  .fire-2 {
    display: none;
    position: absolute;
    height: 55px;
    width: 55px;
    top: 180px;
    transform-origin: 50% 50%;
    transform: rotate(-33deg) skew(0deg, -30deg);
    z-index: 15;
    left: 58px;
    background: linear-gradient(135deg, #E82134 0%, #E82134 50%, #EF8B32 50%, #EF8B32 100%);
    -webkit-animation-delay: 0.2s;
            animation-delay: 0.2s;
  }

  .fire-3 {
    position: absolute;
    height: 22px;
    width: 22px;
    top: 196px;
    left: 58px;
    transform-origin: 50% 50%;
    transform: rotate(-33deg) skew(0deg, -30deg);
    z-index: 20;
    background: linear-gradient(135deg, #EF8B32 0%, #EF8B32 50%, #E82134 50%, #E82134 100%);
    -webkit-animation-delay: 0.2s;
            animation-delay: 0.2s;
  }

  .fire-4 {
    position: absolute;
    height: 22px;
    width: 22px;
    top: 200px;
    transform-origin: 50% 50%;
    transform: rotate(-33deg) skew(0deg, -30deg);
    z-index: 20;
    left: 126px;
    background: linear-gradient(135deg, #E82134 0%, #E82134 50%, #EF8B32 50%, #EF8B32 100%);
  }

  .propulsed, .spark-4, .spark-3, .spark-2, .spark-1 {
    -webkit-animation: dancing_fire 0.24s infinite;
            animation: dancing_fire 0.24s infinite;
  }

  .spark-1 {
    position: absolute;
    bottom: 177px;
    z-index: 20;
    right: 70px;
    width: 12px;
    height: 12px;
    background: #EF8B32;
    transform-origin: 50% 50%;
  }

  .spark-2 {
    position: absolute;
    bottom: 147px;
    z-index: 20;
    left: 52px;
    width: 10px;
    height: 10px;
    transform: rotate(45deg);
    background: #EF8B32;
    -webkit-animation-delay: 0.22s;
            animation-delay: 0.22s;
  }

  .spark-3 {
    position: absolute;
    bottom: 90px;
    z-index: 20;
    left: 109px;
    width: 10px;
    height: 10px;
    transform: rotate(45deg);
    background: #E82134;
    -webkit-animation-delay: 0.32s;
            animation-delay: 0.32s;
  }

  .spark-4 {
    position: absolute;
    bottom: 20px;
    left: 83px;
    z-index: 20;
    width: 10px;
    height: 10px;
    background: #EF8B32;
    -webkit-animation-delay: 0.16s;
            animation-delay: 0.16s;
  }

  .hyperspace, .star {
    -webkit-animation: hyperspace 0.4s infinite;
            animation: hyperspace 0.4s infinite;
  }

  .star {
    position: absolute;
    width: 4px;
    height: 20px;
    background: #fff;
    z-index: 90;
  }
  .star.star--1 {
    left: 50px;
    top: -10px;
    -webkit-animation-delay: 0.1s;
            animation-delay: 0.1s;
  }
  .star.star--2 {
    right: 60px;
    top: 30px;
    -webkit-animation-delay: 0.1s;
            animation-delay: 0.1s;
  }
  .star.star--3 {
    top: 80px;
    left: 25px;
    -webkit-animation-delay: 0.2s;
            animation-delay: 0.2s;
  }
  .star.star--4 {
    top: -20px;
    right: 75px;
    -webkit-animation-delay: 0.2s;
            animation-delay: 0.2s;
  }
  .star.star--5 {
    right: 30px;
    top: -60px;
    -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s;
  }
  .star.star--6 {
    right: 160px;
    top: 50px;
    -webkit-animation-delay: 0.4s;
            animation-delay: 0.4s;
  }
  .star.star--7 {
    top: 20px;
    left: 75px;
    -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s;
  }
  .star.star--8 {
    top: -30px;
    right: 95px;
    -webkit-animation-delay: 0.4s;
            animation-delay: 0.4s;
  }
  .star.star--9 {
    right: 30px;
    top: -60px;
    -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s;
  }
  .star.star--10 {
    right: 160px;
    top: 50px;
    -webkit-animation-delay: 0.4s;
            animation-delay: 0.4s;
  }
  .star.star--11 {
    top: 20px;
    left: 75px;
    -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s;
  }
  .star.star--12 {
    top: -30px;
    right: 95px;
    -webkit-animation-delay: 0.4s;
            animation-delay: 0.4s;
  }
  .star.star--13 {
    left: -30px;
    top: -60px;
    -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s;
  }
  .star.star--14 {
    right: -20px;
    top: 50px;
    -webkit-animation-delay: 0.4s;
            animation-delay: 0.4s;
  }
  .star.star--15 {
    top: 20px;
    left: -75px;
    -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s;
  }
  .star.star--16 {
    top: -30px;
    right: -95px;
    -webkit-animation-delay: 0.4s;
            animation-delay: 0.4s;
  }

  @-webkit-keyframes dancing_fire {
    0% {
      transform-origin: 50% 50%;
      transform: translate(0, -10px) scale(1);
      opacity: 1;
    }
    100% {
      transform: translate(0, 50px) scale(1);
      opacity: 0;
    }
  }

  @keyframes dancing_fire {
    0% {
      transform-origin: 50% 50%;
      transform: translate(0, -10px) scale(1);
      opacity: 1;
    }
    100% {
      transform: translate(0, 50px) scale(1);
      opacity: 0;
    }
  }
  @-webkit-keyframes fire_propulsion {
    0% {
      transform: translate(0, -10px) scale(1) rotate(-33deg) skew(0deg, -30deg);
      transform-origin: 50% 50%;
      opacity: 1;
    }
    100% {
      transform: translate(0, 50px) scale(0.7) rotate(-33deg) skew(0deg, -30deg);
      opacity: 0;
    }
  }
  @keyframes fire_propulsion {
    0% {
      transform: translate(0, -10px) scale(1) rotate(-33deg) skew(0deg, -30deg);
      transform-origin: 50% 50%;
      opacity: 1;
    }
    100% {
      transform: translate(0, 50px) scale(0.7) rotate(-33deg) skew(0deg, -30deg);
      opacity: 0;
    }
  }
  @-webkit-keyframes main_fire {
    0% {
      transform: translate(0, 5px) scale(1.1, 1) rotate(-33deg) skew(0deg, -30deg);
    }
    100% {
      transform: translate(0, 0px) scale(1, 1.4) rotate(-33deg) skew(0deg, -30deg);
    }
  }
  @keyframes main_fire {
    0% {
      transform: translate(0, 5px) scale(1.1, 1) rotate(-33deg) skew(0deg, -30deg);
    }
    100% {
      transform: translate(0, 0px) scale(1, 1.4) rotate(-33deg) skew(0deg, -30deg);
    }
  }
  @-webkit-keyframes vibration {
    0% {
      transform: scale(1) translate(0, 0) rotate(45deg);
    }
    50% {
      transform: scale(1) translate(1px, -1px) rotate(45deg);
    }
    100% {
      transform: scale(1) translate(0, 0) rotate(45deg);
    }
  }
  @keyframes vibration {
    0% {
      transform: scale(1) translate(0, 0) rotate(45deg);
    }
    50% {
      transform: scale(1) translate(1px, -1px) rotate(45deg);
    }
    100% {
      transform: scale(1) translate(0, 0) rotate(45deg);
    }
  }
  @-webkit-keyframes hyperspace {
    0% {
      transform: translate(0, -100px) scale(1, 0);
      opacity: 1;
    }
    100% {
      transform: translate(0, 400px) scale(1, 1);
      opacity: 0;
    }
  }
  @keyframes hyperspace {
    0% {
      transform: translate(0, -100px) scale(1, 0);
      opacity: 1;
    }
    100% {
      transform: translate(0, 400px) scale(1, 1);
      opacity: 0;
    }
  }
</style>

<div>
  <div class="scene">
    <div class="wing-left"></div>
    <div class="wing-right"></div>
    <div class="exhaust"></div>
    <div class="capsule">
      <div class="top">
        <div class="shadow"></div>
      </div>
      <div class="base"></div>
    </div>
    <div class="window-big"></div>
    <div class="window-small"></div>
    <div class="fire-1"></div>
    <div class="fire-2"></div>
    <div class="fire-3"></div>
    <div class="fire-4"></div>
    <div class="spark-1"></div>
    <div class="spark-2"></div>
    <div class="spark-3"></div>
    <div class="spark-4"></div>
    <div class="star star--1"></div>
    <div class="star star--2"></div>
    <div class="star star--3"></div>
    <div class="star star--4"></div>
    <div class="star star--5"></div>
    <div class="star star--6"></div>
    <div class="star star--7"></div>
    <div class="star star--8"></div>
    <div class="star star--9"></div>
    <div class="star star--10"></div>
    <div class="star star--11"></div>
    <div class="star star--12"></div>
    <div class="star star--13"></div>
    <div class="star star--14"></div>
    <div class="star star--15"></div>
    <div class="star star--16"></div>
  </div>
</div>
