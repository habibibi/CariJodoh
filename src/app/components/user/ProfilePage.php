<!DOCTYPE html>
<html>
    <head>
        <title>CariJodoh</title>
        <link rel="shortcut icon" href="/public/images/icons/loveicon.png">
    </head>

    <style>
        body {
            background-color: #FFF8DC;
        }

        .circle {
            height: 200px;
            width: 200px;
            background-color: #FF91A4;
            
            border-radius: 50%;
            border-color: #323949;
            border-style: solid;

            margin-top: 20px;
            margin-left: 35px;

        }

        .rectangle {
            background-color: #FF91A4;
            
            border-radius: 25px;
            border-radius: 25px;
            border-color: #323949;
            border-style: solid;
        }

        .rectangle_ikuti {
            height: 50px;
            width: 150px;
            background-color: #FF91A4;
            
            margin-top: 30px;
            margin-left: 650px;
            
            border-radius: 25px;
            border-color: #323949;
            border-style: solid;

            align-items: center;
        }

        .ikuti {
            font-size: 35px;
            font-weight: bold;
            font-family: Garamond, serif;
            margin-left: 39px;
            margin-top: auto 0;
        }
        
        .group1 {
            display: flex;
        }

        .bookmark {
            margin-top: 40px;
            margin-left: 20px;
        }
        
        .report {
            margin-left: 20px;
            margin-top: 40px;
        }

        .video {
            height: 500px;
            width: 300px;
            background-color: #FF91A4;
            
            margin-top: 200px;
            margin-left: 30px;
            
            border-radius: 25px;
            border-color: #323949;
            border-style: solid;

            align-items: center;
            position: absolute;
            z-index: -1;
        }

        .photo_trial {
            height: 190px;
            width: 190px;
            
            border-radius: 50%;

            margin-top: 100px;
            margin-left: 100px;

            position: absolute;
            z-index: 2;
        }

        .apostrophe {
            position: absolute;
            z-index: 2;
            
            margin-left: 375px;
            margin-top: -150px;
        }

        .id {
            position: absolute;
            margin-top: 100px;
            margin-left: 800px;
        }

        .nama {
            position: absolute;
            margin-top: -10px;
            margin-left: 375px;
        }

        .panggilan {
            position: absolute;
            margin-top: 70px;
            margin-left: 375px;
        }

        .tanya_suka {
            position: absolute;
            margin-top: 5px;
            margin-left: 375px;
        }

        .quote {
            text-align: center;
        }

        .group2 {
            display: flex;
        }

        h3 {
            text-align: justify;
            margin-right: 20px;
            margin-top: 15px;
            font-size: 25px;
        }

        .profile {
            height: 500px;
            width: 300px;
            background-color: #FF91A4;
            
            margin-top: -15px;
            margin-left: 30px;
            
            border-radius: 25px;
            border-color: #323949;
            border-style: solid;

            align-items: center;
            position: absolute;
        }

        .group3 {
            display: flex;
        }

        .square {
            margin-left: 10px;
            height: 20px;
            width: 20px;
            background-color: aqua;
        }
    </style>

    <body>
        <div class="group1">
            <div class="circle"></div>
            <div class="video"></div>
            <div class="photo_trial">
                <img src="../images/assets/profile_trial.png" alt="profile picture">
            </div>
            
            <div class="rectangle_ikuti">
                <span class="ikuti">Ikuti</span>
            </div>

            <div class="bookmark">
                <img src="../images/icons/bookmark.png" alt="bookmark" style="width:128px;height:128px">
            </div>

            <div class="report">
                <img src="../images/icons/report.png" alt="report" style="width:128px;height:128px">
            </div>

            <div class="id">
                <h2 style="font-family:Courier">@OGGY_THE_CAT_CONTOHIDPANJANG</h2>
            </div>

            <div class="nama">
                <h2 style="font-family:Candara;font-size: 50px;">OGGY THE CAT</h2>
            </div>

            <div class="panggilan">
                <h2 style="font-family:Garamond;font-size: 40px;">Panggil saya: OGGY</h2>
            </div>
        </div>

        
        
        <div class="rectangle" style="width:950px;height:150px;margin-top: -25px;margin-left: 365px;">
            <div class="quote">
                <h3 style="font-family:Arial;text-align:center;">Do you like makan indomie setengah mateng?<br>
                    Yeah, meow too! Check my profile!</h3>
            </div>
        </div>
        <div class="apostrophe">
            <img src="../images/icons/apostrophe.png">
        </div>

        <div class="tanya_suka">
            <h2 style="font-family:Garamond;font-size: 40px;">Apa yang OGGY suka?</h2> 
        </div>

        <div class="rectangle" style="width:950px;height:93px;margin-top: 100px;margin-left: 365px;">
            <h3 style="font-family:Arial;margin-left:75px;">Nonton TV, bersihin rumah dari kecoak, masak pie susu, ngemil whiskas, berjemur di depan rumah, dll, dll, dll</h3>
        </div>
        
        <div class="rectangle" style="width:950px;height:93px;margin-top: 10px;margin-left: 365px;">
            <h3 style="font-family:Arial;margin-left:75px;">Horor, astronomi, golf, pokemon, sains komputer</h3>
        </div>
        
        <div class="rectangle" style="width:950px;height:93px;margin-top: 10px;margin-left: 365px;">
            <h3 style="font-family:Arial;margin-left:75px;">Kecoak, anjing galak, kuliah informatika, tomat mentah</h3>
        </div>



        <div class="group2">
            <div class="profile">
                <h2 style="font-family:Garamond;font-size: 40px;text-align: center;">Profil OGGY</h2>
            </div>
            <div class="rectangle" style="width:950px;height:450px;margin-top: 60px;margin-left: 365px;">
                <h2 style="font-family:Garamond;font-size: 40px;margin-left: 20px;margin-top: 20px;">TENTANG OGGY</h2>
                <h3 style="font-family:Arial;margin-left: 20px;margin-top: 20px;">Halo para kucing cantik! Meow meow meow meow.. meoow, meee, moww, meow meow. Maeee maw mow meow. Meow, meow meowww! Meow meow meow meow.. meooaw, meee, moww, meow meow. Meow maw mow meow. Meow, meow meowww! Maeee maw mow meow. Meow, meow MEOWWW! Saya adalah Oggy, kucing petualang yang tinggal di rumah yang sering dihantui oleh kecoak-kecoak nakal. Meskipun mereka sering membuat kekacauan, saya selalu berusaha mengusir mereka dengan kelincahan dan kelihaian saya.</h3>
            </div>
        </div>


        <div class="group3">
            <div class="rectangle" style="width:1350px;height:450px;margin-top: 60px;margin-left: 30px;">
                <h2 style="font-family:Garamond;font-size: 60px;text-align: left;margin-left: 20px;margin-top: 20px;">MBTI</h2>
            </div>
            <div class="rectangle" style="width:950px;height:450px;margin-top: 60px;margin-left: 20px;">
                <h2 style="font-family:Garamond;font-size: 40px;margin-left: 20px;margin-top: 20px;">LOVE LANGUAGE</h2>
                <h3 style="font-family:Arial;margin-left: 20px;margin-top: 20px;font-size: 30px;">
                    Words of Affirmation
                        <div class="square">
                            <img src="../images/icons/check.png">
                        </div>
                    <br><br>Gifts
                    <br><br>Acts of Service
                    <br><br>Quality Time
                    <br><br>Physical Touch</h3>
            </div>
        </div>
    </body>
</html>