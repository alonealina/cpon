// 以下情報バー切り替えについて
let infoBasic = document.querySelector(".info_basic");
let infoAccess = document.querySelector(".info_access");
let infoPay = document.querySelector(".info_pay");
let infoOther = document.querySelector(".info_other");
let infoListBasic = document.getElementById("info_list_basic");
let infoListAccess = document.getElementById("info_list_access");
let infoListPay = document.getElementById("info_list_pay");
let infoListOther = document.getElementById("info_list_other");
let imgBasic = document.getElementById("img_basic");
let imgBasicCurrent = document.getElementById("img_basic_current");
let imgAccess = document.getElementById("img_access");
let imgAccessCurrent = document.getElementById("img_access_current");
let imgPay = document.getElementById("img_siharai");
let imgPayCurrent = document.getElementById("img_siharai_current");
let imgOther = document.getElementById("img_haguruma");
let imgOtherCurrent = document.getElementById("img_haguruma_current");

infoBasic.addEventListener("click", function () {
    infoBasic.classList.add("current");
    infoAccess.classList.remove("current");
    infoPay.classList.remove("current");
    infoOther.classList.remove("current");
    infoListBasic.hidden = false;
    infoListAccess.hidden = true;
    infoListPay.hidden = true;
    infoListOther.hidden = true;
    imgBasic.hidden = true;
    imgBasicCurrent.hidden = false;
    imgAccess.hidden = false;
    imgAccessCurrent.hidden = true;
    imgPay.hidden = false;
    imgPayCurrent.hidden = true;
    imgOther.hidden = false;
    imgOtherCurrent.hidden = true;
});

infoAccess.addEventListener("click", function () {
    infoAccess.classList.add("current");
    infoBasic.classList.remove("current");
    infoPay.classList.remove("current");
    infoOther.classList.remove("current");
    infoListBasic.hidden = true;
    infoListAccess.hidden = false;
    infoListPay.hidden = true;
    infoListOther.hidden = true;
    imgBasic.hidden = false;
    imgBasicCurrent.hidden = true;
    imgAccess.hidden = true;
    imgAccessCurrent.hidden = false;
    imgPay.hidden = false;
    imgPayCurrent.hidden = true;
    imgOther.hidden = false;
    imgOtherCurrent.hidden = true;
});

infoPay.addEventListener("click", function () {
    infoPay.classList.add("current");
    infoBasic.classList.remove("current");
    infoAccess.classList.remove("current");
    infoOther.classList.remove("current");
    infoListBasic.hidden = true;
    infoListAccess.hidden = true;
    infoListPay.hidden = false;
    infoListOther.hidden = true;
    imgBasic.hidden = false;
    imgBasicCurrent.hidden = true;
    imgAccess.hidden = false;
    imgAccessCurrent.hidden = true;
    imgPay.hidden = true;
    imgPayCurrent.hidden = false;
    imgOther.hidden = false;
    imgOtherCurrent.hidden = true;
});

infoOther.addEventListener("click", function () {
    infoOther.classList.add("current");
    infoBasic.classList.remove("current");
    infoAccess.classList.remove("current");
    infoPay.classList.remove("current");
    infoListBasic.hidden = true;
    infoListAccess.hidden = true;
    infoListPay.hidden = true;
    infoListOther.hidden = false;
    imgBasic.hidden = false;
    imgBasicCurrent.hidden = true;
    imgAccess.hidden = false;
    imgAccessCurrent.hidden = true;
    imgPay.hidden = false;
    imgPayCurrent.hidden = true;
    imgOther.hidden = true;
    imgOtherCurrent.hidden = false;
});
