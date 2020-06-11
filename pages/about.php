<style>
    @import url('https://fonts.googleapis.com/css?family=Josefin+Sans:100,300,400,600,700');

body {
    background: #fff;
    font-family: 'Josefin Sans', sans-serif
}

h3 {
    font-family: 'Josefin Sans', sans-serif
}

.box {
    padding: 30px 0px
}

.box-part {
    background: #F0FFFF;
    padding: 60px 10px;
    margin: 10px 0px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    margin-bottom: 25px
}

.box-part:hover {
    background: #000000
}

.box-part:hover .fa,
.box-part:hover .title,
.box-part:hover .text,
.box-part:hover a {
    color: #FFF;
    -webkit-transition: all 1s ease-out;
    -moz-transition: all 1s ease-out;
    -o-transition: all 1s ease-out;
    transition: all 1s ease-out
}

.text {
    margin: 20px 0px
}

.fa {
    color: #00BFFF
}
</style>

<div class="box" style="size: 50">
    <div class="content-wrapper">

        <center>
            <div class="row">
            <div class="col-md">
                        <div class="card-body">
                        <center><h2 class="card-title">Abous Us</h2> </center>
                            <hr>
                            <div style="margin-left: 20px; margin-right: 20px;">
                                <p class="card-text text-justify">
                                Aplikasi ini dirancang dengan Bahasa Pemrograman PHP Native, Mysql sebagai DBMS, Materialize & Boostraps sebagai Framework CSS, dan Icon menggunakan font awesome dan Materialize icon
                            </p>                                                       
                        </div>
                    </div>
               
            </div>
        </div>
        </center>


        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="box-part text-center"> 
                    <i class="fas fa fa-youtube" aria-hidden="true" style="font-size: 30px;"></i>
                    <div class="title">
                        <h3>Youtube</h3>
                    </div>
                    <div class="text"> <span>Follow us on google for future updates</span> </div> <a href="#">Learn More</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="box-part text-center"> <i class="fa fa-twitter" style="font-size: 30px;" aria-hidden="true"></i>
                    <div class="title">
                        <h3>Twitter</h3>
                    </div>
                    <div class="text"> <span>Follow us on twitter for future updates</span> </div> <a href="#">Learn More</a>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="box-part text-center"> <i class="fas fa fa-instagram" style="font-size: 30px;" aria-hidden="true"></i>
                    <div class="title">
                        <h3>Instagram</h3>
                    </div>
                    <div class="text"> <span>Follow us on facebook for future updates</span> </div> <a href="#">Learn More</a>
                </div>
            </div>
            
        </div>


    </div>
</div>
