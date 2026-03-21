#!/bin/bash

# ═══════════════════════════════════════════════════════════════════════════════
#  INSTALL SCRIPT — Sistem Informasi SD Negeri Warialau
#  Mendukung: Linux & macOS
#  Kebutuhan: Docker Desktop / Docker Engine + Docker Compose
# ═══════════════════════════════════════════════════════════════════════════════

set -e

# ── Warna output ──────────────────────────────────────────────────────────────
RED='\033[0;31m'; GREEN='\033[0;32m'; YELLOW='\033[1;33m'
BLUE='\033[0;34m'; CYAN='\033[0;36m'; BOLD='\033[1m'; NC='\033[0m'

print_header() {
    echo ""
    echo -e "${BLUE}${BOLD}╔══════════════════════════════════════════════════════╗${NC}"
    echo -e "${BLUE}${BOLD}║     Sistem Informasi SD Negeri Warialau              ║${NC}"
    echo -e "${BLUE}${BOLD}║     Docker Installer — Linux / macOS                 ║${NC}"
    echo -e "${BLUE}${BOLD}╚══════════════════════════════════════════════════════╝${NC}"
    echo ""
}

ok()   { echo -e "${GREEN}  ✔  $1${NC}"; }
info() { echo -e "${CYAN}  ➜  $1${NC}"; }
warn() { echo -e "${YELLOW}  ⚠  $1${NC}"; }
fail() { echo -e "${RED}  ✘  $1${NC}"; exit 1; }
step() { echo -e "\n${BOLD}${BLUE}▶ $1${NC}"; }

# ── Cek Docker ────────────────────────────────────────────────────────────────
check_docker() {
    step "Memeriksa instalasi Docker"
    if ! command -v docker &>/dev/null; then
        fail "Docker tidak ditemukan. Install Docker dari https://docs.docker.com/get-docker/"
    fi
    ok "Docker ditemukan: $(docker --version)"

    if ! docker compose version &>/dev/null && ! command -v docker-compose &>/dev/null; then
        fail "Docker Compose tidak ditemukan. Install Docker Compose terlebih dahulu."
    fi
    ok "Docker Compose ditemukan"

    if ! docker info &>/dev/null; then
        fail "Docker daemon tidak berjalan. Jalankan Docker Desktop terlebih dahulu."
    fi
    ok "Docker daemon aktif"
}

# ── Setup .env ────────────────────────────────────────────────────────────────
setup_env() {
    step "Menyiapkan file konfigurasi .env"

    if [ ! -f ".env" ]; then
        if [ -f ".env.docker" ]; then
            cp .env.docker .env
            ok ".env dibuat dari .env.docker"
        elif [ -f ".env.example" ]; then
            cp .env.example .env
            warn ".env dibuat dari .env.example — pastikan konfigurasi sudah benar"
        else
            fail "File .env.docker atau .env.example tidak ditemukan"
        fi
    else
        ok ".env sudah ada, melewati langkah ini"
    fi

    # Pastikan REDIS_HOST = redis (service Docker)
    if grep -q "REDIS_HOST=127.0.0.1" .env; then
        sed -i 's/REDIS_HOST=127.0.0.1/REDIS_HOST=redis/' .env
        ok "REDIS_HOST diupdate ke 'redis' (Docker service name)"
    fi

    # Pastikan REDIS_CLIENT = predis
    if grep -q "REDIS_CLIENT=phpredis" .env; then
        sed -i 's/REDIS_CLIENT=phpredis/REDIS_CLIENT=predis/' .env
        ok "REDIS_CLIENT diupdate ke 'predis'"
    fi
}

# ── Siapkan database SQLite ───────────────────────────────────────────────────
setup_database() {
    step "Menyiapkan database SQLite"
    DB_FILE="database/laravel1234"
    if [ ! -f "$DB_FILE" ]; then
        touch "$DB_FILE"
        ok "File database SQLite dibuat: $DB_FILE"
    else
        ok "Database sudah ada: $DB_FILE"
    fi
    chmod 664 "$DB_FILE"
}

# ── Build Docker images ───────────────────────────────────────────────────────
build_containers() {
    step "Build Docker image (mungkin membutuhkan beberapa menit pertama kali)"
    docker compose build --no-cache
    ok "Docker image berhasil dibangun"
}

# ── Jalankan container ────────────────────────────────────────────────────────
start_containers() {
    step "Menjalankan container"
    docker compose up -d
    ok "Semua container berjalan"
    echo ""
    docker compose ps
}

# ── Setup Laravel ─────────────────────────────────────────────────────────────
setup_laravel() {
    step "Setup Laravel"

    info "Generate APP_KEY..."
    docker compose exec app php artisan key:generate --force
    ok "APP_KEY berhasil digenerate"

    info "Menjalankan database migration..."
    docker compose exec app php artisan migrate --force
    ok "Migration selesai"

    info "Menjalankan seeder..."
    docker compose exec app php artisan db:seed --force
    ok "Seeder selesai"

    info "Membuat storage symlink..."
    docker compose exec app php artisan storage:link
    ok "Storage symlink dibuat"

    info "Optimasi aplikasi..."
    docker compose exec app php artisan config:cache
    docker compose exec app php artisan route:cache
    docker compose exec app php artisan view:cache
    ok "Optimasi selesai"

    info "Set permissions storage..."
    docker compose exec app chmod -R 775 storage bootstrap/cache
    docker compose exec app chown -R www-data:www-data storage bootstrap/cache
    ok "Permissions sudah diset"
}

# ── Selesai ───────────────────────────────────────────────────────────────────
print_done() {
    echo ""
    echo -e "${GREEN}${BOLD}╔══════════════════════════════════════════════════════╗${NC}"
    echo -e "${GREEN}${BOLD}║            INSTALASI BERHASIL! ✔                     ║${NC}"
    echo -e "${GREEN}${BOLD}╚══════════════════════════════════════════════════════╝${NC}"
    echo ""
    echo -e "  🌐  Website   : ${BOLD}http://localhost:8000${NC}"
    echo -e "  🔐  Admin     : ${BOLD}http://localhost:8000/admin${NC}"
    echo -e "  👤  Email     : ${BOLD}admin@admin.com${NC}"
    echo -e "  🔑  Password  : ${BOLD}admin${NC}"
    echo ""
    echo -e "${YELLOW}  ⚠  Ganti password admin setelah login pertama!${NC}"
    echo ""
    echo -e "  Perintah berguna:"
    echo -e "    docker compose stop          — hentikan container"
    echo -e "    docker compose start         — jalankan kembali"
    echo -e "    docker compose logs -f       — lihat log"
    echo -e "    docker compose down -v       — hapus semua container & volume"
    echo ""
}

# ── Main ──────────────────────────────────────────────────────────────────────
print_header
check_docker
setup_env
setup_database
build_containers
start_containers
setup_laravel
print_done
