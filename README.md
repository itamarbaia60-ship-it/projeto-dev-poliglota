Projeto desenvolvido como atividade prática do curso Técnico em Desenvolvimento de Sistemas da EETEPA IEEP, sob orientação do Prof. Mathaus Borges (2026). Demonstra a integração colaborativa e a interoperabilidade entre PHP, Java e Python, utilizando um banco de dados MySQL centralizado (via XAMPP) como canal de comunicação e persistência entre os módulos.

## 📑 Sumário

- [Objetivos](#-objetivos)
- [Ambiente e Configuração](#-ambiente-e-configuração)
- [Arquitetura do Sistema](#-arquitetura-do-sistema)
- [Fluxo de Dados](#-fluxo-de-dados)
- [Como Executar](#-como-executar)
- [Controle de Versão e Colaboração](#-controle-de-versão-e-colaboração)
- [Melhorias Futuras](#-melhorias-futuras)

## 🎯 Objetivos

Demonstrar, por meio de um sistema funcional, a comunicação entre módulos desenvolvidos em linguagens distintas, articulados em torno de uma base de dados comum, evidenciando conceitos de interoperabilidade, arquitetura desacoplada e trabalho colaborativo em equipe.

## ⚙️ Ambiente e Configuração

### Banco de Dados e Servidor

A execução do ecossistema requer a inicialização dos serviços Apache e MySQL no painel de controle do XAMPP. O acesso administrativo ao banco é realizado via phpMyAdmin (`http://localhost/phpmyadmin`), onde deve ser criada a tabela base do sistema:

```sql
CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    curso VARCHAR(50),
    matricula VARCHAR(20) DEFAULT 'Pendente'
);
```

### Dependências por Linguagem

| Linguagem / Módulo | Conector / Biblioteca | Instalação / Configuração |
|---|---|---|
| PHP 8 | PDO (pdo_mysql) | Nativo no XAMPP (ativo por padrão) |
| Java | JDBC MySQL Connector | Adição do arquivo `.jar` do MySQL Connector/J ao classpath |
| Python | mysql-connector-python | `pip install mysql-connector-python` |

## 🔩 Arquitetura do Sistema

O projeto adota uma arquitetura em esteira de processamento desacoplada, estruturada em três componentes principais que se comunicam por meio de um banco de dados relacional central.

| Módulo / Arquivo | Tecnologia | Papel no Fluxo |
|---|---|---|
| `index.php` | PHP 8 + PDO | Interface web de cadastro (Tailwind CSS), responsável pela gravação inicial do aluno no MySQL com status `matricula = 'Pendente'` |
| `Processador.java` | Java + JDBC | Worker assíncrono que localiza registros pendentes, aplica regras de negócio (formatação em caixa alta e geração de matrícula) e consolida os dados no banco |
| `relatorio.py` | Python + mysql-connector-python | Módulo de BI/relatório via CLI, responsável por consumir os dados consolidados e exibir o relatório gerencial no terminal |

## 📒 Fluxo de Dados

1. **Cadastro e Ingestão (PHP)** — a interface recebe nome e curso via requisição POST e insere o registro na tabela `alunos`, atribuindo ao campo `matricula` o valor padrão `'Pendente'`.
2. **Processamento de Regras de Negócio (Java)** — o script busca registros com `matricula = 'Pendente' LIMIT 1`; ao localizar um, converte o nome para caixa alta (`toUpperCase()`), gera a matrícula no formato `MAT-(1000 + id)` e atualiza o registro correspondente no banco.
3. **Visualização e Relatórios (Python)** — o script consulta os alunos já processados (`WHERE matricula != 'Pendente'`) e apresenta um relatório gerencial formatado no terminal.

## ▶️ Como Executar

1. Inicie os serviços **Apache** e **MySQL** no XAMPP.
2. Crie a tabela `alunos` no phpMyAdmin (script SQL acima).
3. Acesse `index.php` pelo navegador e cadastre um aluno.
4. Compile e execute `Processador.java` para processar os registros pendentes.
5. Execute `relatorio.py` para visualizar o relatório gerencial no terminal.

## 🔀 Controle de Versão e Colaboração

O desenvolvimento é conduzido em trio, com fluxo de trabalho estruturado por meio de repositório centralizado no GitHub (`projeto-dev-poliglota`), utilizando branches e commits individuais integrados diretamente pelo VS Code.

## 💭 Melhorias Futuras

- **Automação de loop/daemon em Java** — implementação de um mecanismo de escuta contínua no `Processador.java`, eliminando a necessidade de reexecução manual para o processamento de novos registros pendentes.
- **Tratamento de erros e logs avançados** — ampliação do tratamento de exceções de conexão com o banco de dados, com geração de registros de log em arquivo para auditoria das transações realizadas por cada módulo.
- **Dashboard web em Python** — evolução da interface CLI de relatórios para uma aplicação web interativa, utilizando frameworks como Streamlit ou Flask/Dash.


O projeto adota uma arquitetura em esteira de processamento desacoplada, estruturada em três componentes principais que se comunicam por meio de um banco de dados relacional central.

Módulo / Arquivo	Tecnologia	Papel no Fluxo
index.php	PHP 8 + PDO	Interface web de cadastro (Tailwind CSS), responsável pela gravação inicial do aluno no MySQL com status matricula = 'Pendente'
Processador.java	Java + JDBC	Worker assíncrono que localiza registros pendentes, aplica regras de negócio (formatação em caixa alta e geração de matrícula) e consolida os dados no banco
relatorio.py	Python + mysql-connector-python	Módulo de BI/relatório via CLI, responsável por consumir os dados consolidados e exibir o relatório gerencial no terminal
5. Fluxo de Dados
Cadastro e Ingestão (PHP): a interface recebe nome e curso via requisição POST e insere o registro na tabela alunos, atribuindo ao campo matricula o valor padrão 'Pendente'.
Processamento de Regras de Negócio (Java): o script busca registros com matricula = 'Pendente' LIMIT 1; ao localizar um, converte o nome para caixa alta (toUpperCase()), gera a matrícula no formato MAT-(1000 + id) e atualiza o registro correspondente no banco.
Visualização e Relatórios (Python): o script consulta os alunos já processados (WHERE matricula != 'Pendente') e apresenta um relatório gerencial formatado no terminal.
6. Controle de Versão e Colaboração

O desenvolvimento é conduzido em trio, com fluxo de trabalho estruturado por meio de repositório centralizado no GitHub (projeto-dev-poliglota), utilizando branches e commits individuais integrados diretamente pelo VS Code.

7. Melhorias Futuras
Automação de loop/daemon em Java: implementação de um mecanismo de escuta contínua no Processador.java, eliminando a necessidade de reexecução manual para o processamento de novos registros pendentes.
Tratamento de erros e logs avançados: ampliação do tratamento de exceções de conexão com o banco de dados, com geração de registros de log em arquivo para auditoria das transações realizadas por cada módulo.
Dashboard web em Python: evolução da interface CLI de relatórios para uma aplicação web interativa, utilizando frameworks como Streamlit ou Flask/Dash.
