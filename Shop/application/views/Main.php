<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      overflow: hidden;
      margin: 0;
      padding: 0;
    }

    .moving-image {
      opacity: 1;
      width: 100%;
      height: 100%;
      position: fixed;
      z-index: -1;
      object-fit: cover;
      transform: translateX(0);
      height: calc(100vh - 40px);
      position: relative;
    }

    .image-container {
      height: 100vh;
      position: relative;
    }

    .ball-container {
      position: absolute;
      bottom: 70px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      justify-content: center;
      z-index: 1;
    }

    .ball {
      height: 15px;
      width: 15px;
      border-radius: 50%;
      background-color: #333;
      margin: 0 5px;
      cursor: pointer;
    }

    .ball.active {
      background-color: gray;
    }

    .centered-content {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      z-index: 1;
    }

    .arrow {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      font-size: 24px;
      color: #333;
      cursor: pointer;
    }

    .arrow.left {
      left: 20px;
    }

    .arrow.right {
      right: 20px;
    }

    button {
      position: relative;
      color: white;
      padding: 10px 70px;
      font-size: 30px;
      background-color: rgba(0, 0, 0, 0.1);
      top: 170px;
      border: 2px solid #ffff;
      outline: none;
      cursor: pointer;
    }
    h1{
      position: relative;
      color: white;
      top: 120px;
      font-size: 30px;
      font-weight: normal;

    }
  </style>
</head>
<body>
  <div class="image-container">
    <img class="moving-image" src="" alt="">
    <div class="ball-container">
      <div class="ball active" onclick="showImage(1)"></div>
      <div class="ball" onclick="showImage(2)"></div>
      <div class="ball" onclick="showImage(3)"></div>
      <div class="ball" onclick="showImage(4)"></div>
    </div>
    <div class="centered-content">
      <h1>Está na hora de vestir a moda das estações com estilo e conforto!</h1>
      <a href="<?= site_url('roupa') ?>">
        <button>Comprar Agora</button>
      </a>
    </div>
    <div class="arrow left" onclick="showPreviousImage()">&#10094;</div>
    <div class="arrow right" onclick="showNextImage()">&#10095;</div>
  </div>

  <script>
    const images = ['<?php echo base_url("assets/img/autumn.jpeg"); ?>', 
                    '<?php echo base_url("assets/img/roupa5.jpg"); ?>',
                    '<?php echo base_url("assets/img/summer.jpeg"); ?>', 
                    '<?php echo base_url("assets/img/winter.jpeg"); ?>'];
    let currentIndex = 0;
    let intervalId;

    function showImage(index) {
      currentIndex = index - 1;
      clearInterval(intervalId); 
      updateActiveBall(index);
      updateMovingImage();
      startSlideshow();
    }

    function showNextImage() {
      currentIndex = (currentIndex + 1) % images.length;
      updateActiveBall(currentIndex + 1);
      updateMovingImage();
    }

    function showPreviousImage() {
      currentIndex = (currentIndex - 1 + images.length) % images.length;
      updateActiveBall(currentIndex + 1);
      updateMovingImage();
    }

    function updateActiveBall(index) {
      const activeBalls = document.querySelectorAll('.ball.active');
      for (let i = 0; i < activeBalls.length; i++) {
        activeBalls[i].classList.remove('active');
      }
      document.querySelector(`.ball:nth-child(${index})`).classList.add('active');
    }

    function updateMovingImage() {
      const movingImage = document.querySelector('img.moving-image');
      if (movingImage) {
        movingImage.src = images[currentIndex];
      } else {
        console.error('img.moving-image not found');
      }
    }

    function startSlideshow() {
      intervalId = setInterval(showNextImage, 10000); 
    }

    showImage(1);

    
    document.addEventListener('keydown', function (event) {
      switch (event.key) {
        case 'ArrowLeft':
          showPreviousImage();
          break;
        case 'ArrowRight':
          showNextImage();
          break;
        default:
          break;
      }
    });
  </script>
</body>
</html>
