FROM php

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd

RUN apt-get clean && rm -rf /var/lib/apt/lists/*


COPY ./ ./

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000"]

# docker build -t pdf .
# docker run -p 3005:8000 pdf