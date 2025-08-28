# =============================================================================
# Service Provider App - Docker Development Makefile
# =============================================================================

# Variables
COMPOSE_FILE := docker-compose.dev.yaml
APP_CONTAINER := service_provider
DB_CONTAINER := service_provider_db
REDIS_CONTAINER := service_provider_redis
NGINX_CONTAINER := service_provider_nginx

# Colors for output
GREEN := \033[0;32m
YELLOW := \033[1;33m
RED := \033[0;31m
NC := \033[0m # No Color

# =============================================================================
# Main Commands
# =============================================================================

.PHONY: help
help: ## Show this help message
	@echo "$(GREEN)Service Provider App - Available Commands:$(NC)"
	@echo ""
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  $(YELLOW)%-20s$(NC) %s\n", $$1, $$2}'

.PHONY: dev
dev: ## Start development environment
	@echo "$(GREEN)Starting development environment...$(NC)"
	docker-compose -f $(COMPOSE_FILE) up -d
	@echo "$(GREEN)Waiting for services to be ready...$(NC)"
	@make wait-for-services
	@make install-deps
	@make setup-app
	@echo "$(GREEN)Development environment ready!$(NC)"
	@echo "$(YELLOW)App: http://localhost:8002$(NC)"
	@echo "$(YELLOW)Database: localhost:3306$(NC)"
	@echo "$(YELLOW)Redis: localhost:6379$(NC)"

# =============================================================================
# Development Commands
# =============================================================================

.PHONY: install-deps
install-deps: ## Install PHP and Node dependencies
	@echo "$(GREEN)Installing PHP dependencies...$(NC)"
	docker exec $(APP_CONTAINER) composer install --no-interaction --optimize-autoloader
	@echo "$(GREEN)Installing Node dependencies...$(NC)"
	docker exec $(APP_CONTAINER) npm install

.PHONY: setup-app
setup-app: ## Setup Laravel application
	@echo "$(GREEN)Setting up Laravel application...$(NC)"
	@make generate-key
	@make migrate
	@make seed
	@make build-assets

.PHONY: generate-key
generate-key: ## Generate Laravel application key
	@echo "$(GREEN)Generating application key...$(NC)"
	docker exec $(APP_CONTAINER) php artisan key:generate

.PHONY: migrate
migrate: ## Run database migrations
	@echo "$(GREEN)Running database migrations...$(NC)"
	docker exec $(APP_CONTAINER) php artisan migrate --force

.PHONY: seed
seed: ## Run database seeders
	@echo "$(GREEN)Running database seeders...$(NC)"
	docker exec $(APP_CONTAINER) php artisan db:seed --force

.PHONY: build-assets
build-assets: ## Build frontend assets
	@echo "$(GREEN)Building frontend assets...$(NC)"
	docker exec $(APP_CONTAINER) yarn dev

# =============================================================================
# Default target
# =============================================================================
.DEFAULT_GOAL := help
