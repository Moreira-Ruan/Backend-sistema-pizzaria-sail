
# Documentação Completa para Configuração do Ambiente Laravel Sail e Docker

## 1. Introdução

Este documento cobre todo o processo de configuração para rodar um ambiente de desenvolvimento Laravel usando **Docker**, **Docker Compose**, e **Laravel Sail**. Também inclui a criação de um alias para o Laravel Sail, a instalação da extensão Docker no Visual Studio Code e a configuração para que o Laravel Sail possa rodar diretamente no terminal do VS Code. Além disso, são abordados comandos úteis e outros tópicos relevantes para o ambiente de desenvolvimento.

---

## 2. Instalação do Docker e Docker Compose

### 2.1 Atualizar o sistema

Antes de iniciar, é importante garantir que o sistema esteja atualizado. Execute os comandos a seguir:

```bash
sudo apt update
sudo apt upgrade
```

### 2.2 Instalar pacotes de dependências

Instale as dependências necessárias:

```bash
sudo apt install apt-transport-https ca-certificates curl software-properties-common
```

### 2.3 Adicionar a chave GPG do Docker

Adicione a chave GPG do Docker para garantir a autenticidade dos pacotes:

```bash
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
```

### 2.4 Adicionar o repositório do Docker

Agora, adicione o repositório oficial do Docker ao seu sistema:

```bash
echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
```

### 2.5 Instalar Docker e Docker Compose

Atualize os pacotes e instale Docker:

```bash
sudo apt update
sudo apt install docker-ce docker-ce-cli containerd.io
```

Para instalar o Docker Compose, execute:

```bash
sudo apt install docker-compose-plugin
```

### 2.6 Verificar a instalação

Verifique se o Docker e Docker Compose foram instalados corretamente:

```bash
docker --version
docker-compose --version
```

---

## 3. Instalação do Laravel Sail

O Laravel Sail é uma interface que facilita o uso de containers Docker para projetos Laravel.

### 3.1 Criar ou importar um projeto Laravel

Se você deseja criar um novo projeto Laravel, use o seguinte comando:

```bash
sail composer create-project --prefer-dist laravel/laravel nome-do-projeto
cd nome-do-projeto
```

Para um projeto existente, navegue até o diretório do projeto:

```bash
cd /caminho/para/seu-projeto
```

### 3.2 Instalar o Laravel Sail

No diretório do seu projeto, execute o seguinte comando para instalar o Laravel Sail:

```bash
sail composer require laravel/sail --dev
```

### 3.3 Configurar o Laravel Sail

Após a instalação, configure o Sail com:

```bash
sail artisan sail:install
```

Aqui você poderá escolher quais serviços (como MySQL, Redis) deseja usar no seu ambiente.

### 3.4 Inicializar o Laravel Sail

Para rodar o Laravel Sail e iniciar os containers, execute:

```bash
sail up
```

Para rodar os containers em segundo plano (detached mode):

```bash
sail up -d
```

### 3.5 Limpeza de Cache no Laravel

Para limpar o cache de configurações, rotas e visualizações no Laravel, use os comandos:

```bash
sail artisan config:clear
sail artisan route:clear
sail artisan view:clear
sail artisan cache:clear
sail artisan optimize
```

Esses comandos são úteis para evitar problemas de cache desatualizado em seu ambiente de desenvolvimento.

---

## 4. Criação de Alias para o Laravel Sail

Criar um alias para o Laravel Sail ajuda a encurtar o comando necessário para iniciar e gerenciar os containers.

### 4.1 Criar o alias no terminal

Abra o arquivo de configuração do seu shell (`.bashrc` ou `.zshrc`):

Para `bash`:

```bash
nano ~/.bashrc
```

Para `zsh`:

```bash
nano ~/.zshrc
```

### 4.2 Adicionar o alias

Adicione o seguinte código ao final do arquivo:

```bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

### 4.3 Salvar e aplicar as mudanças

Após adicionar o alias, salve e recarregue o shell com:

Para `bash`:

```bash
source ~/.bashrc
```

Para `zsh`:

```bash
source ~/.zshrc
```

Agora você pode usar o comando `sail` diretamente no terminal.

---

## 5. Instalação da Extensão Docker no VS Code

A extensão Docker no Visual Studio Code permite que você gerencie containers e volumes diretamente na interface do editor.

### 5.1 Instalar a Extensão Docker

1. Abra o **VS Code**.
2. Vá até a aba **Extensões** (atalho `Ctrl + Shift + X`).
3. Busque por "Docker" e instale a extensão oficial da Microsoft.

### 5.2 Configurações úteis da Extensão Docker

Após a instalação, a extensão permitirá que você visualize e gerencie containers Docker, volumes e redes, diretamente no painel lateral do **VS Code**.

---

## 6. Configuração do Laravel Sail no Terminal do VS Code

O Laravel Sail pode ser executado diretamente no terminal integrado do VS Code. Para isso, algumas configurações podem ser úteis.

### 6.1 Configurar o terminal para o Laravel Sail

1. No **VS Code**, abra as configurações (`Ctrl + ,`).
2. Na barra de pesquisa, digite "terminal integrated shell".
3. Escolha o shell que você utiliza (bash ou zsh) e certifique-se de que ele está configurado para carregar o arquivo `.bashrc` ou `.zshrc` com o alias criado para o Sail.

### 6.2 Executar o Laravel Sail no terminal integrado

Com o alias configurado e o terminal configurado corretamente, abra o terminal integrado (`Ctrl + `) e execute:

```bash
sail up
```

Isso permitirá iniciar o Laravel Sail diretamente no terminal integrado do **VS Code**.

---

## 7. Outras Informações Relevantes

### 7.1 Verificar o Status dos Containers

Use o comando abaixo para verificar o status dos containers rodando pelo Sail:

```bash
sail ps
```

### 7.2 Parar os Containers

Para parar os containers sem removê-los, execute:

```bash
sail stop
```

### 7.3 Derrubar os Containers

Para derrubar (parar e remover) os containers e liberar recursos:

```bash
sail down
```

### 7.4 Verificar os Logs de Erro

Em caso de problemas, os logs podem ser verificados no diretório `storage/logs/laravel.log`. Para visualizar os logs de um container específico, use:

```bash
sail logs nome-do-container
```

---

## 8. Conclusão

Este guia cobre desde a instalação do Docker e Docker Compose, até a configuração do Laravel Sail e a execução de comandos úteis para desenvolvimento em containers Docker. Com essas etapas concluídas, você terá um ambiente de desenvolvimento robusto e integrado ao **VS Code**.
