FROM node:20-alpine

WORKDIR /app

# Copia i file package.json e package-lock.json
COPY package*.json ./

# Rimuovi node_modules e installa le dipendenze
RUN rm -rf node_modules && npm install

# Copia il resto dei file
COPY . .

CMD ["npm", "run", "dev"]
