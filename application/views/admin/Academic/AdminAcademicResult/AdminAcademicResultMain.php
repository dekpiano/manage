<style>
.border-left-primary {
    border-left: .25rem solid #5BC3D5 !important;
}

.toggle-button-cover {
    display: table-cell;
    position: relative;
    width: 200px;
    height: 140px;
    box-sizing: border-box;
}

.button-cover {
    height: 100px;
    margin: 20px;
    background-color: #fff;
    box-shadow: 0 10px 20px -8px #c5d6d6;
    border-radius: 4px;
}

.button-cover:before {
    counter-increment: button-counter;
    content: counter(button-counter);
    position: absolute;
    right: 0;
    bottom: 0;
    color: #d7e3e3;
    font-size: 12px;
    line-height: 1;
    padding: 5px;
}

.button-cover,
.knobs,
.layer {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}

.button {
    position: relative;
    top: 50%;
    width: 74px;
    height: 36px;
    overflow: hidden;
}

.button.r,
.button.r .layer {
    border-radius: 100px;
}

.button.b2 {
    border-radius: 2px;
}

.checkbox {
    position: relative;
    width: 100%;
    height: 100%;
    padding: 0;
    margin: 0;
    opacity: 0;
    cursor: pointer;
    z-index: 3;
}

.knobs {
    z-index: 2;
}

.layer {
    width: 100%;
    background-color: #fcebeb;
    transition: 0.3s ease all;
    z-index: 1;
}

/* Button 1 */
#button-1 .knobs:before {
    content: "ปิด";
    position: absolute;
    top: 4px;
    left: 4px;
    width: 30px;
    height: 30px;
    color: #fff;
    font-size: 10px;
    font-weight: bold;
    text-align: center;
    line-height: 1;
    padding: 9px 4px;
    background-color: #f44336;
    border-radius: 50%;
    transition: 0.3s cubic-bezier(0.18, 0.89, 0.35, 1.15) all;
}

#button-1 .checkbox:checked+.knobs:before {
    content: "เปิด";
    left: 42px;
    background-color: #03a9f4;
}

#button-1 .checkbox:checked~.layer {
    background-color: #ebf7fc;
}

#button-1 .knobs,
#button-1 .knobs:before,
#button-1 .layer {
    transition: 0.3s ease all;
}
</style>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="app-page-title">
            <h2 class="heading">จัดการข้อมูล<?=$title;?></h2>
        </div>
        <!--//container-->
        <hr>
        <section class="we-offer-area">
            <div class="container-fluid">

                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">แสดงผลการเรียนของนักเรียน</h3>
                        <div class="section-intro">เปิด - ปิดการแสดงผลการเรียนของนักเรียน</div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="app-card app-card-settings shadow-sm p-3">
                            <div class="app-card-body">
                                <div class="col-auto">
                                    <div class="button r" id="button-1">
                                        <input class="checkbox" type="checkbox" id="checkOnOffDoGrade"
                                            name="checkOnOffDoGrade" value="<?=$checkOnOff[0]->onoff_status;?>"
                                            <?=$checkOnOff[0]->onoff_status == 'false' ? '' : 'checked';?>>
                                        <div class="knobs"></div>
                                        <div class="layer"></div>
                                    </div>
                                </div>
                            </div>
                            <!--//app-card-body-->

                        </div>
                        <!--//app-card-->
                    </div>
                </div>


            </div>
        </section>

    </div>
    <!--//main-wrapper-->