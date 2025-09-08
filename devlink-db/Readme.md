# DevLinkUp - Banco de Dados (devlink-db)

Este diretório contém a configuração do banco de dados MySQL do projeto **DevLinkUp**, utilizando **Docker** e **Docker Compose**.

---

## 📂 Estrutura do Projeto

- **data/** → Armazena os dados persistentes do MySQL
- **docker-compose.yml** → Arquivo de configuração dos serviços (MySQL e phpMyAdmin)

---

## 🚀 Como iniciar o ambiente

1. Certifique-se de ter o **Docker** e **Docker Compose** instalados.
2. Dentro da pasta `devlink-db`, execute:
   ```bash
   docker-compose up -d
   ```
