{{-- <h2>Hello</h2> <br><br>
You have got an email from : {{ $first_name }} <br><br>
User details: <br><br>
Name: {{ $first_name }} {{ $last_name }} <br>
Email: {{ $email }} <br>
Subject: Contact US <br>
Message: {{ $user_query }} <br><br>
Thanks --}}

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Phone List</title>
    <style type="text/css">
      body {
        margin: 0px;
        padding: 0px;
      }

      @media only screen and (max-width: 660px) {
        table.container {
          width: 480px !important;
        }
        td.logo img {
          display: none;
        }
        td.logo {
          background: #fff url(images/logo_medium.gif) no-repeat 10px 10px;
          height: 45px;
        }
        td.headline {
          padding: 5px 0px 0px 30px !important;
        }
        td.headline h1 {
          font-size: 28px !important;
        }
        td.banner img {
          display: none;
        }
        td.banner {
          width: 480px;
          height: 150px;
          background: url(images/banner_medium.jpg) no-repeat 0px 0px;
        }
        td.content {
          padding-bottom: 30px !important;
          background-image: url(images/banner_medium_ghost.jpg) !important;
        }
        td.content table.button {
          width: auto;
        }
        td.content table.button td a {
          font-size: 14px !important;
        }
        td.promos table {
          width: 200px !important;
        }
        td.promos table td h3 {
          margin-bottom: 8px;
        }
        td.promos table td img {
          display: none;
        }
        td.promos table.promo_1 td {
          background: url(images/promo_1_medium.jpg) no-repeat 0px 0px;
          padding: 100px 0px 0px 0px;
        }
        td.promos table.promo_2 td {
          background: url(images/promo_2_medium.jpg) no-repeat 0px 0px;
          padding: 100px 0px 0px 0px;
        }
        td.callout table {
          width: 50% !important;
          margin-bottom: 40px;
        }
        td.callout table img {
          display: none;
        }
        td.callout table br {
          display: none;
        }
        td.callout table a {
          display: block;
          margin-top: 10px;
        }
        td.callout table td {
          background: 65px 65px;
        }
        td.callout table.callout_1 td {
          padding: 0px 30px 0px 60px !important;
          background: url(images/icon_grapes.gif) no-repeat 0px -13px;
        }
        td.callout table.callout_2 td {
          padding: 0px 20px 0px 60px !important;
          background: url(images/icon_bottle.gif) no-repeat 10px -3px;
        }
        td.callout table.callout_3 td {
          padding: 0px 30px 0px 60px !important;
          background: url(images/icon_basket.gif) no-repeat 0px -13px;
          clear: left;
        }
        td.callout table.callout_4 td {
          padding: 0px 20px 0px 60px !important;
          background: url(images/icon_camera.gif) no-repeat 10px -23px;
        }
      }

      @media only screen and (max-width: 510px) {
        table.container {
          width: 100% !important;
        }
        table.container td {
          border: none !important;
        }
        td.logo {
          background: #fff url(images/logo_small.gif) no-repeat center 10px;
          height: 32px;
        }
        td.headline h1 {
          font-size: 24px !important;
          text-align: center;
        }
        td.banner {
          height: 115px;
          background: url(images/banner_small.jpg) no-repeat right 0px;
        }
        td.content {
          line-height: 20px !important;
          padding-bottom: 10px !important;
          background: #f5f2e5 url(images/banner_small_ghost.jpg) no-repeat 0px !important;
        }
        td.footer {
          padding: 20px 30px !important;
        }
        td.promos table.promo_1 {
          width: 100% !important;
          border-top: 1px solid #71a412;
        }
        td.promos table.promo_1 td {
          background: url(images/promo_1_small.jpg) no-repeat 0px 40px;
          padding: 20px 0px 40px 110px;
        }
        td.promos table.promo_2 {
          width: 100% !important;
        }
        td.promos table.promo_2 td {
          background: url(images/promo_2_small.jpg) no-repeat 0px 20px;
          padding: 0px 0px 0px 110px;
          clear: left;
        }
        td.callout {
          padding: 20px 30px 0px 30px !important;
        }
        td.callout table {
          width: 100% !important;
          margin-bottom: 20px;
        }
        td.callout table td {
          padding: 0px 0px 10px 50px !important;
          background-size: 50px 50px !important;
          min-height: 60px;
        }
        td.callout table a {
          display: inline;
        }
        td.callout table.callout_1 td {
          background-position: 0px -6px;
        }
        td.callout table.callout_2 td {
          background-position: 4px -2px;
        }
        td.callout table.callout_1 td {
          background-position: 0px -7px;
        }
        td.callout table.callout_1 td {
          background-position: 4px -17px;
        }
        td.callout table br.spacer {
          display: inline;
        }
      }
    </style>
  </head>
  <body bgcolor="#efe1b0">
    <div style="font-size: 1px; color: #efe1b0; display: none">
      👋Welcome to Phone List
    </div>

    <table
      width="100%"
      border="0"
      cellspacing="0"
      cellpadding="0"
      bgcolor="#F7F9FB"
    >
      <tr>
        <td>
          <table
            class="container"
            width="640"
            align="center"
            border="0"
            cellpadding="0"
            cellspacing="0"
          >
            <tr>
              <td
                valign="top"
                class="logo"
                bgcolor="#ffffff"
                style="
                  padding: 10px 20px 0px 30px;
                  border-left: 1px solid #dbc064;
                  border-right: 1px solid #dbc064;
                  border-top: 1px solid #dbc064;
                "
              >
                <a href="#"
                  ><img
                    style="margin-left: -15px"
                    src="images/logo_large.gif"
                    alt="Our Vineyard"
                    width="585"
                    height="45"
                    border="0"
                /></a>
              </td>
            </tr>
            <tr>
              <td
                valign="top"
                class="headline"
                bgcolor="#ffffff"
                style="
                  padding: 15px 20px 5px 30px;
                  border-left: 1px solid #dbc064;
                  border-right: 1px solid #dbc064;
                  font-family: Arial, Helvetica, sans-serif;
                  font-size: 16px;
                  line-height: 22px;
                "
              >
                <h1
                  style="
                    margin: 0px 0px 15px 0px;
                    font-weight: 600;
                    font-size: 26px;
                    color: #555555;
                    text-align: center;
                  "
                >
                  Hi Shamonti, your export is ready.
                </h1>
              </td>
            </tr>
            <tr>
              <td
                valign="top"
                bgcolor="#f5f2e5"
                class="content"
                style="
                  padding: 30px 30px 10px 30px;
                  border-right: 1px solid #dbc064;
                  border-left: 1px solid #dbc064;
                  font-family: Arial, Helvetica, sans-serif;
                  font-size: 16px;
                  line-height: 22px;
                  color: #654308;
                    no-repeat 0px 0px;
                "
              >
                <table
                  width="200"
                  align="left"
                  class="button"
                  style="margin: 0px 0px 10px 11rem"
                >
                  <tr>
                    <td
                      style="
                        text-align: center;
                        background-color: #71a412;
                        padding: 10px 15px;
                        border-radius: 5px;
                      "
                    >
                      <a
                        href="#"
                        style="
                          color: #ffffff;
                          font-size: 18px;
                          letter-spacing: 1px;
                          text-decoration: none;
                          text-shadow: 0px 2px 2px #3a5606;
                          font-family: Arial, Helvetica, sans-serif;
                        "
                        >Download CSV</a
                      >
                    </td>
                  </tr>
                </table>
              </td>
            </tr>

            <tr>
              <td
                valign="top"
                class="footer"
                style="
                  padding: 10px 0px 30px 0px;
                  font-family: Arial, Helvetica, sans-serif;
                  font-size: 11px;
                  color: #b2a16e;
                "
              >
                &copy; Your Company Name. PLEASE DO NOT REPLY TO THIS MESSAGE:
                <br /><br />
                Your <a href="#" style="color: #000000">privacy</a> is important
                to us. Please use this link to
                <a href="#" style="color: #000000">unsubscribe</a>. <br /><br />
                Lorem ipsum dolor sit amet consectetur adipi sicing elit sed do
                eiusmod tempor inci didunt ut labore et dolore iqua. Ut enim ad
                minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                aliquip ex ea commodo consequat.
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>
