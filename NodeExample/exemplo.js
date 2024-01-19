var http = require('http');
var json = require('./json.json')

http.createServer(function(req,res) {
   //res.setHeader('Location','https://www.w3schools.com/jsref/event_onclick.asp') 
   //res.statusCode = 302
   res.setHeader('Access-Control-Allow-Origin','*')
   var url = req.url
   console.log(url)
   //favicons são pequenas imagens que ficam guardados no site para visualização pelo navegador.
   if (url != "/" && url != "/favicon.ico"){
      var singed = /exp=(.*)/.exec(req.url) 
      //console.log(Object.entries(singed))
      singed = singed[1] //controla o caminho

      if(singed == "pescador")
         //res.write(JSON.stringify(json.profissao.pescador),loop(json.profissao.pescador))
         res.write(profissaoHMTL(json.profissao.pescador),loop(json.profissao.pescador))
      else if(singed == "dentista")
         res.write(profissaoHMTL(json.profissao.dentista),loop(json.profissao.dentista))
      else if(singed == "empregado")
         res.write(profissaoHMTL(json.profissao.empregado),loop(json.profissao.empregado))
      else if(singed == "programador")
         res.write(profissaoHMTL(json.profissao.programador),loop(json.profissao.programador))
      else if(singed == "quadrado") {
         res.write( 
         '<html>'+
         '<head>'+
         '<meta charset="UTF-8"></meta>'+
         '<title>Trabalho</title>'+
         '<style>'+
         'body{ background-color: coral;}'+
         'h1{text-align: center;}'+
         '</style>'+
         '</head>'+
         '<body>'+
         '<h1>Consola ativa</h1>'+
         '</body>'+
         //'<img src="'+object.img+'">'+
         '</html>')
         const readline = require('readline');
         const rl = readline.createInterface({ 
           input: process.stdin, 
           output: process.stdout 
         }); 

         rl.question('escolha: ', (input) => {
            const comando = input.split(' ');
            

            if(comando[0] == '#tamanho'){
               console.log("Qual tamanho quer?(grande/medio/pequeno)");
               if(input == "grande") {
               //size alt e largura 600px
               res.end();
               return;
               }
               else if(input == "medio"){
               //size alt e largura 200px
               res.end();
               return;
               }
               else if(input == "pequeno"){
               //size alt e largura 50px
               res.end();
               return;
               }
            }
         
            if(comando[0] == '#cor'){
               console.log("qual cor quer?")
               res.write(basic(comando[1]));
            rl.close();
            res.end();
            }   
          });
      }
   }else{
      res.write(basic());
      
   res.end();
   }
}).listen(3213);

function ligar(x) {
   console.warn(`O servidor chamado ${x} esta ligado, o port do servidor é ${y}`);
}
  
const x = 'Trabalho';
const y = '3213'
ligar(x);


const loop = (array) => {
  /* array.forEach((element) => {
     console.log(element);
   })*/
   for(var chave in array){
      console.log(array[chave])
   }
}

function profissaoHMTL(object){
   return (       
   '<html>'+
   '<head>'+
   '<meta charset="UTF-8"></meta>'+
   '<title>Trabalho</title>'+
   '<style>'+
   'body{ background-color: coral;}'+
   'img{max-width: 100%;height: auto;}'+
   '</style>'+
   '</head>'+
   '<body>'+
   '<input type="button" value="Voltar" onclick="history.back()">'+
   '<span><h3><strong><i>Profissao:</i></strong></h3></span><br/>'+
   '<span><strong>'+object.nome+'</strong></span><br/>'+
   '<span>salario-> '+object.salario+'</span><br/>'+
   '<span>localizaçao-> '+object.localizaocao+'</span><br/>'+
   '<span>telefone-> '+object.telefone+'</span><br/>'+
   '<img src="https://api.lorem.space/image/movie">'+
   //'<img src="'+object.img+'">'+
   '</html>'
   )
}
 


function basic(cor = "black") {
   return ('<html>'+
   '<head>'+
   '<meta charset="UTF-8"></meta>'+
   '<title>Trabalho</title>'+
   '<style>'+
   'body {background: ' + 'white' + ';}' +
   '.quadrado{position:absolute; height: 50px; width: 50px; background-color: '+cor+';}'+//'+tamanho+'
   '.block {'+
   'width: 50%;'+
   'border: none;'+
   'background-color: #04AA6D;'+
   'padding: 10px 10px;'+
   'font-size: 16px;'+
   'text-align: center;'+
   'margin: 5px auto;' +
   '}'+
   '</style>'+
   '</head>'+
   '<body>'+
   '<span><h3><strong><i>Profissoes:</i></strong></h3></span><br/>'+
   '<form method="get">'+
   '<button name="exp" value="pescador" class="block" ><strong>Pescador<strong></button><br/>'+
   '<button name="exp" value="dentista" class="block"><strong>Dentista</button><br/>'+
   '<button name="exp" value="empregado" class="block"><strong>Empregado</button><br/>'+
   '<button name="exp" value="programador" class="block"><strong>Programador</button><br/>'+
   '<div class="quadrado"></div>'+
   '<button name="exp" value="quadrado" class="block"><strong>Quadrado</button><br/>'+
   '</form>'+
   //'<script> function emprego() { document.getElementById("prof").innerHTML = "inscrito"; }</script>'+ -> ao clicar inscrever vai aparecer inscrito
   '</body>'+
   '</html>');
}