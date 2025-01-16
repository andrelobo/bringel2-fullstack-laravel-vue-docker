# Estágio de build
FROM node:18-alpine AS build-stage

# Atualizar e instalar bash (opcional para debugging)
RUN apk update && apk add --no-cache bash

# Definir diretório de trabalho no contêiner
WORKDIR /app

# Copiar arquivos necessários para instalar dependências
COPY package.json package-lock.json ./

# Instalar dependências
RUN npm install

# Copiar o restante do projeto
COPY . .

# Construir a aplicação
RUN npm run build

# Estágio de produção com Nginx
FROM nginx:stable-alpine AS production-stage

# Copiar arquivos construídos para o diretório padrão do Nginx
COPY --from=build-stage /app/dist /usr/share/nginx/html

# Copiar configuração personalizada do Nginx (se aplicável)
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Expor a porta 80 para o Nginx
EXPOSE 80

# Iniciar o Nginx
CMD ["nginx", "-g", "daemon off;"]
