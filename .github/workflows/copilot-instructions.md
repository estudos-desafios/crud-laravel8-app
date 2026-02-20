# GitHub Copilot – Repository Instructions
# Projeto: PHP / Laravel

Estas instruções definem como o GitHub Copilot deve gerar código, exemplos e sugestões
neste repositório Laravel.

---

## 📌 Linguagem e Estilo

- Todo código deve ser escrito em **PHP 8.1+**, compatível com Laravel.
- Seguir rigorosamente o padrão **PSR-12**.
- Usar **type hints** em parâmetros, retornos e propriedades sempre que possível.
- Preferir `strict types` quando aplicável.
- Código deve ser legível, explícito e orientado à manutenção.

---

## 🧱 Convenções Laravel

- Classes: **StudlyCase**
- Métodos e variáveis: **camelCase**
- Controllers devem ser **finos** (thin controllers).
- Regras de negócio devem ficar fora dos Controllers.

Estrutura recomendada:
- Controllers → orquestração
- Services / Actions → regras de negócio
- Models → relacionamento e escopos
- Form Requests → validação
- Jobs / Events / Listeners → processamento assíncrono e desacoplamento

---

## 🗄️ Eloquent e Banco de Dados

- Prefira **Eloquent** ou **Query Builder** em vez de SQL bruto.
- Use **Query Scopes** para filtros reutilizáveis.
- Evite lógica complexa dentro de Models.
- Sempre considerar **N+1 queries** e sugerir `with()` quando necessário.
- Migrations devem ser reversíveis e explícitas.

---

## 🔐 Segurança e Validação

- Sempre utilizar **Form Requests** para validação de entrada.
- Nunca confiar em dados vindos da requisição.
- Evitar mass assignment sem `$fillable` ou `$guarded`.
- Preferir Policies e Gates para autorização.
- Nunca expor dados sensíveis em responses, logs ou exceptions.

---

## 🧪 Testes

- Gerar testes utilizando **PHPUnit** e ferramentas nativas do Laravel.
- Preferir:
  - `RefreshDatabase`
  - Model Factories
  - Testes de Feature para endpoints HTTP
- Testes devem ser claros, determinísticos e isolados.
- Nomear testes de forma descritiva.

---

## 🧩 Arquitetura e Design

- Favorecer **SOLID** e separação de responsabilidades.
- Preferir **injeção de dependência** em vez de Facades quando o código precisar ser testável.
- Evitar acoplamento direto entre camadas.
- Sugerir uso de DTOs quando houver transporte de dados estruturados.
- Evitar lógica condicional complexa em Controllers.

---

## ⚙️ Jobs, Eventos e Filas

- Jobs devem ser idempotentes sempre que possível.
- Eventos devem representar fatos do domínio.
- Listeners devem ter responsabilidade única.
- Evitar lógica de negócio pesada em Listeners.

---

## 📦 Respostas HTTP e APIs

- APIs devem seguir padrão REST.
- Usar **Resources (JsonResource)** para transformação de dados.
- Respostas devem ser consistentes (status code + payload).
- Evitar retornar Models diretamente em APIs públicas.

---

## 📝 Comentários e Documentação

- Comentários devem explicar **o porquê**, não o óbvio.
- Métodos públicos complexos devem ter PHPDoc.
- Código gerado deve priorizar clareza em vez de abstrações excessivas.

---

## 🚫 O que evitar

- Controllers com lógica de negócio pesada.
- Uso indiscriminado de Facades.
- SQL bruto sem justificativa.
- Métodos longos e com múltiplas responsabilidades.
- Código sem tipagem quando for possível tipar.

---

## 🎯 Objetivo Final

Gerar código:
- Limpo
- Testável
- Idiomático do Laravel
- Seguro
- Fácil de manter
