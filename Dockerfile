WORKDIR /usr/share/nginx/
RUN rm -rf /usr/share/nginx/html
RUN ln -s public html