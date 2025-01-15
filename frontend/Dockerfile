# Estágio de build: Usando Node.js com npm como base
FROM node:18-alpine AS build-stage

# Configuração do diretório de trabalho no contêiner
WORKDIR /app

# Copiar apenas os arquivos de dependências para o contêiner
COPY package.json package-lock.json ./

# Instalar dependências utilizando npm
RUN npm install --production=false

# Copiar o restante do código do projeto para o contêiner
COPY . .

# Construir o aplicativo para produção
RUN npm run build

# ---

# Estágio de produção: Usando Nginx como servidor
FROM nginx:stable-alpine AS production-stage

# Copiar os arquivos buildados do estágio anterior para o diretório padrão do Nginx
COPY --from=build-stage /app/dist /usr/share/nginx/html

# Adicionar configuração personalizada do Nginx (se aplicável)
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Expor a porta 80 usada pelo Nginx
EXPOSE 80

# Comando para manter o Nginx em execução no contêiner
CMD ["nginx", "-g", "daemon off;"]