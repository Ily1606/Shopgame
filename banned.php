
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=NTR|Open+Sans:400,600,700&display=swap" rel="stylesheet">
    <style>
        * {
          margin: 0;
          padding: 0;
          -webkit-box-sizing: border-box;
                  box-sizing: border-box;
        }
        html {
          font-size: 16px;
        }
        html,
        body {
          width: 100%;
          height: 100%;
        }
        body {
          font-family: "Open Sans", "Roboto", "Helvetica", "Arial", sans-serif;
        }
        #ssp-tech-works {
          font-size: 1.4rem;
          max-width: 1000px;
          width: 70%;
          padding: 70px;
        }
        #ssp-tech-works p {
          margin-bottom: 15px;
        }
        #ssp-tech-works p:last-child {
          margin-bottom: 0;
        }
        h1 {
          text-transform: uppercase;
          font-size: 4rem;
          color: #41357a;
          margin-bottom: 7px;
          line-height: 1.1;
          font-family: 'NTR', sans-serif;
        }
        .ssp-tech-works__picture {
          position: absolute;
          right: 0;
          bottom: 0.1px;
          width: 100%;
        }
        .ssp-tech-works__picture img {
          width: 100%;
          display: block;
        }
        /*************** media queries start ***********/
        @media only screen and (max-width: 1200px) {
          h1 {
            font-size: 3rem;
          }
        }
        @media only screen and (max-width: 768px) {
          body {
            -webkit-box-align: start;
            -webkit-align-items: flex-start;
                -ms-flex-align: start;
                    align-items: flex-start;
          }
          #ssp-tech-works {
            width: 100%;
            padding: 35px;
          }
        }
        @media only screen and (max-width: 320px) {
          html {
            font-size: 13px;
          }
          .ssp-tech-works__picture {
            width: 85%;
          }
        }
        @media screen and (max-width: 768px) and (orientation: landscape) {
          body {
            -webkit-box-pack: start;
            -webkit-justify-content: flex-start;
                -ms-flex-pack: start;
                    justify-content: flex-start;
          }
          #ssp-tech-works {
            padding: 21px;
            font-size: 1.1rem;
          }
          h1 {
            font-size: 2.5rem;
          }
          .ssp-tech-works__picture {
            width: 40%;
          }
        }
        /*************** media queries end ***********/

    </style>
</head>

<body>
    <section id="ssp-tech-works">    
        <h1>Cần một ít kiên nhẫn</h1>
        <p>
            Kính gửi bạn! 
        </p>
        <p>
            Chúng tôi rất xin lỗi vì sự bất tiện này, các kỹ thuật viên đang tiến hành nâng cấp toàn bộ hệ thống, một số tính năng thú vị sắp ra mắt! Chúng tôi đánh giá cao sự kiên nhẫn của bạn.
        </p>
        <p>
            Chúng tôi sẽ trở lại sớm thôi,<br>
            Đội ngũ kỹ thuật viên Shopgame.
        </p>
    </section>
    <div class="ssp-tech-works__picture">
        <img src="https://images.pushmobilenews.com/tech_astronaut.svg" alt="">
    </div>
</body>

</html>
