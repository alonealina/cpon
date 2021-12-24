// 以下情報バー切り替えについて
let infoBasicIpad = document.querySelector(".info_basic_ipad");
let infoAccessIpad = document.querySelector(".info_access_ipad");
let infoPayIpad = document.querySelector(".info_pay_ipad");
let infoOtherIpad = document.querySelector(".info_other_ipad");
let infoListBasicIpad = document.getElementById("info_list_basic_ipad");
let infoListAccessIpad = document.getElementById("info_list_access_ipad");
let infoListPayIpad = document.getElementById("info_list_pay_ipad");
let infoListOtherIpad = document.getElementById("info_list_other_ipad");

infoBasicIpad.addEventListener("click", function () {
    infoBasicIpad.classList.add("current");
    infoAccessIpad.classList.remove("current");
    infoPayIpad.classList.remove("current");
    infoOtherIpad.classList.remove("current");
    infoListBasicIpad.hidden = false;
    infoListAccessIpad.hidden = true;
    infoListPayIpad.hidden = true;
    infoListOtherIpad.hidden = true;
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
});
