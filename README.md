# 🐾 Patas Digitais – Inovação e Empatia ao Alcance de um Clique

**Patas Digitais** é uma aplicação web desenvolvida como Projeto Integrador do curso de **Tecnologia da Informação da UFMS**. O objetivo é conectar protetores de animais, ONGs e a sociedade, facilitando a adoção responsável, o envio seguro de denúncias e a arrecadação de doações — tudo em um ambiente digital acessível, seguro e empático.

🔗 Acesse em: (https://patasdigitais.top)

---

## 🔧 Funcionalidades

✅ Cadastro e login de usuários  
✅ Listagem de animais com fotos, vídeos e informações completas  
✅ Canal de denúncia anônima com opção de anexar imagem ou vídeo  
✅ Página de doações via Pix (QR Code e chave aleatória)  
✅ Painel administrativo exclusivo para a ONG  
✅ Página "Quem somos" com FAQ e formulário de contato  
✅ Interface responsiva, moderna e intuitiva

---

## 🧰 Tecnologias Utilizadas

| Stack       | Ferramenta/Descrição                        |
|-------------|---------------------------------------------|
| 🌐 **Frontend**  | `HTML5`, `CSS3`, `JavaScript`              |
| 🎨 **Layout**    | [Bootstrap](https://getbootstrap.com/) 🟦 – para responsividade e design moderno |
| 🐘 **Backend**   | `PHP` – lógica da aplicação e integração com o banco |
| 🗃️ **Banco de Dados** | `MySQL` gerenciado via `phpMyAdmin` |

---

## 🚀 Deploy da Aplicação

O deploy foi realizado manualmente por meio de hospedagem tradicional, utilizando os serviços da [Superdomínios](https://www.superdominios.org). A seguir, o passo a passo que utilizei:

1. **Registro de domínio e hospedagem**  
   Contratei o plano de hospedagem e adquiri o domínio `patasdigitais.top` diretamente pela Superdomínios.

2. **Upload dos arquivos via gerenciador**  
   Acessei o painel da Superdomínios (cPanel) e utilizei o **Gerenciador de Arquivos** para enviar todos os arquivos do projeto para a pasta `public_html`.

3. **Criação do banco de dados**  
   - Criei um banco de dados MySQL e um usuário com permissões completas através do cPanel.  
   - Importe o arquivo `banco.sql` (incluso neste repositório) usando o `phpMyAdmin`.

4. **Configuração de conexão com o banco**  
   No arquivo `conexao.php`, atualizei os dados de acesso conforme as credenciais criadas:
   ```php
   $host = "localhost";
   $usuario = "SEU_USUARIO";
   $senha = "SUA_SENHA";
   $banco = "NOME_DO_BANCO";
