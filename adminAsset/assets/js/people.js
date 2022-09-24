'use strict';

let genderInput = document.getElementById('genderInput');
let relationshipInput = document.getElementById('relationshipInput');
let countryInput = document.getElementById('countryInput');
let ageInput = document.getElementById('ageInput');

document.querySelector('.maleBtn').addEventListener('click', function () {
  genderInput.value = document.querySelector('.maleBtn').value;
});

document.querySelector('.femaleBtn').addEventListener('click', function () {
  genderInput.value = document.querySelector('.femaleBtn').value;
});

document.querySelector('.singleBtn').addEventListener('click', function () {
  relationshipInput.value = document.querySelector('.singleBtn').value;
});

document.querySelector('.relationBtn').addEventListener('click', function () {
  relationshipInput.value = document.querySelector('.relationBtn').value;
});

document.querySelector('.engagedBtn').addEventListener('click', function () {
  relationshipInput.value = document.querySelector('.engagedBtn').value;
});

document.querySelector('.marriedBtn').addEventListener('click', function () {
  relationshipInput.value = document.querySelector('.marriedBtn').value;
});

document.querySelector('.openBtn').addEventListener('click', function () {
  relationshipInput.value = document.querySelector('.openBtn').value;
});

document
  .querySelector('.complicatedBtn')
  .addEventListener('click', function () {
    relationshipInput.value = document.querySelector('.complicatedBtn').value;
  });

//Show warning for pagination

document.querySelector('.warning').addEventListener('mouseover', function () {
  document.querySelector('.pagination-warning').classList.remove('d-none');
});
document.querySelector('.warning').addEventListener('mouseout', function () {
  document.querySelector('.pagination-warning').classList.add('d-none');
});
