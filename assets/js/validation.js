const axios=require('axios');

let name = document.getElementById('name');
let project = document.getElementById('project');
let validationResult = document.getElementById('validation-result');
let validationResult2 = document.getElementById('validation-result2');

const validateName = function () {
    validationResult.innerText = '...';
    axios.post(validationResult.dataset.path,{input:name.value})
        .then(function(response){
            if (response.data.valid){
                validationResult.innerText = ":)";
            }else{
                validationResult.innerText = ":(";
            }
        })
        .catch(function (error) {
            validationResult.innerText = 'Error: ' + error;
        });
};

const validateProject = function () {
    validationResult2.innerText = '...';
    axios.post(validationResult2.dataset.path,{input:project.value})

        .then(function(response){
            if (response.data.valid){
                validationResult2.innerText = ":)";
            }else{
                validationResult2.innerText = ":(";
            }
        })
        .catch(function (error) {
            validationResult2.innerText = 'Error: ' + error;
        });
};

name.onkeyup = validateName;
name.onchange = validateName;
project.onkeyup = validateProject;
project.onchange = validateProject;