#!/bin/sh

# Đường dẫn đến thư mục backend
BACKEND_DIR="backend"

# Kiểm tra nếu file .env đã tồn tại trong thư mục backend
if [ ! -f "$BACKEND_DIR/.env" ]; then
    cp "$BACKEND_DIR/.env.example" "$BACKEND_DIR/.env"
    echo "Nhập giá trị JWT_SECRET của bạn:"
    read JWT_SECRET
    echo "Nhập giá trị MEILISEARCH_KEY của bạn:"
    read MEILISEARCH_KEY

    # Thay thế các placeholder bằng giá trị thực
    sed -i "s/your_jwt_secret_here/$JWT_SECRET/" "$BACKEND_DIR/.env"
    sed -i "s/your_meilisearch_key_here/$MEILISEARCH_KEY/" "$BACKEND_DIR/.env"

    echo "Đã cập nhật file .env với các giá trị bí mật trong thư mục backend"
else
    echo "File .env đã tồn tại trong thư mục backend. Vui lòng kiểm tra và cập nhật nếu cần."
fi
