# Pakai OS Linux mini yang udah ada Node.js versi 20
FROM node:20-alpine

# Bikin folder 'app' di dalam Docker sebagai tempat kerja
WORKDIR /app

# Copy file package.json dan package-lock.json dulu
COPY package*.json ./

# Install semua dependency (node_modules)
RUN npm install

# Copy semua sisa file project kamu ke dalam Docker
COPY . .

# Buka port 3000 biar bisa diakses dari luar Docker
EXPOSE 3000

# Perintah yang dijalankan saat Docker start (sama kayak yang kamu ketik di terminal)
CMD ["npm", "run", "dev"]
