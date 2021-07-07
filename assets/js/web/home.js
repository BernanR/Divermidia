//file button configscustom-file-button
const realFile = document.getElementById('real_file_home');
const customButton = document.getElementById('custom-file-button');
const customText = document.getElementById('custom-file-text');

customButton.onclick = () =>{//quando user clica no 'fake' button, clicar no "real botão"
    realFile.click();
}

let archiveSelected = false;

realFile.onchange = () =>{
    
    if(realFile.value){        
        let file = realFile.files[0];
        let size = file.size;
        let filename = file.name;

        if(size <= 1048576){//1MB
            archiveSelected = true;
            customText.innerHTML = filename;   

        }else{
            archiveSelected = false;
            file = '';
            alert('Selecione um arquivo de no máximo 1MB.');
        }

    }else{
        
        customText.innerHTML = 'nenhum arquivo selecionado';
    }
}

//onsubmit form - verificar tamanho do arquivo
const form = document.getElementById('form');
form.onsubmit = () => {
    if(realFile.files[0]){
        const file = realFile.files[0];
        const size = file.size;
        if(file !== '' || file !== undefined){
            if(size > 1048576){
                alert('Para prosseguir, o arquivo selecionado, deve ter até 1MB.')
                return false;
            }
            
        }//caso user não selecione arquivo, continua o submit
    }
    return true;
        
}

