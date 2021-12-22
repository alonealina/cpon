// 以下情報バー切り替えについて
let infoBasic = document.querySelector(".info_basic");
let infoAccess = document.querySelector(".info_access");
let infoPay = document.querySelector(".info_pay");
let infoOther = document.querySelector(".info_other");
let infoListBasic = document.getElementById("info_list_basic");
let infoListAccess = document.getElementById("info_list_access");
let infoListPay = document.getElementById("info_list_pay");
let infoListOther = document.getElementById("info_list_other");

infoBasic.addEventListener("click", function () {
    infoBasic.classList.add("current");
    infoAccess.classList.remove("current");
    infoPay.classList.remove("current");
    infoOther.classList.remove("current");
    infoListBasic.hidden = false;
    infoListAccess.hidden = true;
    infoListPay.hidden = true;
    infoListOther.hidden = true;
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
});
