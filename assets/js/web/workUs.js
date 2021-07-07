//file button configscustom-file-button
const realFile = document.querySelector('#real_file');
const customButton = document.querySelector('#custom-file-button');
const customText = document.querySelector('#custom-file-text');

customButton.onclick = () =>{//quando user clica no 'fake' button, clicar no "real botão"
    console.log('clicou');
    realFile.click();
}
const form = document.getElementById('form');


const radioButtons = document.getElementsByName('areaOption');

form.onsubmit = () =>{    
    // if(!acceptedFile){       
    //     console.log('ARQUIVO NÃO VÁLIDO')
    //     alert('Selecione um arquivo válido para o currículo (apenas .pdf ou .docx)')
    //     return false;
    // }
    
    return true;
}


let acceptedFile = false;

realFile.onchange = () =>{
    if(realFile.value){
        let file = realFile.files[0];
        let type = file.type;
        let filename = file.name;

        console.log(file.type)
        console.log(realFile)

        if(type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || type === 'application/pdf'){
            console.log('docx ou pdf archive selected');
            customText.innerHTML = filename;
            acceptedFile = true;
            return true;
        }else{
            customText.innerHTML = 'Nenhum arquivo selecionado';
            alert('Você precisa selecionar um arquivo do tipo .pdf ou .docx');
            file = '';
            file.value = '';
            acceptedFile = false;
            return false;
        }
    }else{
        acceptedFile = false;
        customText.innerHTML = 'Nenhum arquivo selecionado';
    }
}
