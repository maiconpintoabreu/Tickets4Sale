FROM node:10-alpine as builder
RUN mkdir /angularapp
COPY . /angularapp/
RUN cd /angularapp && npm ci --unsafe-perm

FROM nginx
COPY --from=builder /angularapp/app/ /usr/share/nginx/html
EXPOSE 80