// 以下情報バー切り替えについて
let infoBasicIpad = document.querySelector(".info_basic_ipad");
let infoAccessIpad = document.querySelector(".info_access_ipad");
let infoPayIpad = document.querySelector(".info_pay_ipad");
let infoOtherIpad = document.querySelector(".info_other_ipad");
let infoListBasicIpad = document.getElementById("info_list_basic_ipad");
let infoListAccessIpad = document.getElementById("info_list_access_ipad");
let infoListPayIpad = document.getElementById("info_list_pay_ipad");
let infoListOtherIpad = document.getElementById("info_list_other_ipad");
let imgBasicIpad = document.getElementById("img_basic_ipad");
let imgBasicCurrentIpad = document.getElementById("img_basic_current_ipad");
let imgAccessIpad = document.getElementById("img_access_ipad");
let imgAccessCurrentIpad = document.getElementById("img_access_current_ipad");
let imgPayIpad = document.getElementById("img_siharai_ipad");
let imgPayCurrentIpad = document.getElementById("img_siharai_current_ipad");
let imgOtherIpad = document.getElementById("img_haguruma_ipad");
let imgOtherCurrentIpad = document.getElementById("img_haguruma_current_ipad");

infoBasicIpad.addEventListener("click", function () {
    infoBasicIpad.classList.add("current");
    infoAccessIpad.classList.remove("current");
    infoPayIpad.classList.remove("current");
    infoOtherIpad.classList.remove("current");
    infoListBasicIpad.hidden = false;
    infoListAccessIpad.hidden = true;
    infoListPayIpad.hidden = true;
    infoListOtherIpad.hidden = true;
    imgBasicIpad.hidden = true;
    imgBasicCurrentIpad.hidden = false;
    imgAccessIpad.hidden = false;
    imgAccessCurrentIpad.hidden = true;
    imgPayIpad.hidden = false;
    imgPayCurrentIpad.hidden = true;
    imgOtherIpad.hidden = false;
    imgOtherCurrentIpad.hidden = true;
});

infoAccessIpad.addEventListener("click", function () {
    infoAccessIpad.classList.add("current");
    infoBasicIpad.classList.remove("current");
    infoPayIpad.classList.remove("current");
    infoOtherIpad.classList.remove("current");
    infoListBasicIpad.hidden = true;
    infoListAccessIpad.hidden = false;
    infoListPayIpad.hidden = true;
    infoListOtherIpad.hidden = true;
    imgBasicIpad.hidden = false;
    imgBasicCurrentIpad.hidden = true;
    imgAccessIpad.hidden = true;
    imgAccessCurrentIpad.hidden = false;
    imgPayIpad.hidden = false;
    imgPayCurrentIpad.hidden = true;
    imgOtherIpad.hidden = false;
    imgOtherCurrentIpad.hidden = true;
});

infoPayIpad.addEventListener("click", function () {
    infoPayIpad.classList.add("current");
    infoBasicIpad.classList.remove("current");
    infoAccessIpad.classList.remove("current");
    infoOtherIpad.classList.remove("current");
    infoListBasicIpad.hidden = true;
    infoListAccessIpad.hidden = true;
    infoListPayIpad.hidden = false;
    infoListOtherIpad.hidden = true;
    imgBasicIpad.hidden = false;
    imgBasicCurrentIpad.hidden = true;
    imgAccessIpad.hidden = false;
    imgAccessCurrentIpad.hidden = true;
    imgPayIpad.hidden = true;
    imgPayCurrentIpad.hidden = false;
    imgOtherIpad.hidden = false;
    imgOtherCurrentIpad.hidden = true;
});

infoOtherIpad.addEventListener("click", function () {
    infoOtherIpad.classList.add("current");
    infoBasicIpad.classList.remove("current");
    infoAccessIpad.classList.remove("current");
    infoPayIpad.classList.remove("current");
    infoListBasicIpad.hidden = true;
    infoListAccessIpad.hidden = true;
    infoListPayIpad.hidden = true;
    infoListOtherIpad.hidden = false;
    imgBasicIpad.hidden = false;
    imgBasicCurrentIpad.hidden = true;
    imgAccessIpad.hidden = false;
    imgAccessCurrentIpad.hidden = true;
    imgPayIpad.hidden = false;
    imgPayCurrentIpad.hidden = true;
    imgOtherIpad.hidden = true;
    imgOtherCurrentIpad.hidden = false;
});
