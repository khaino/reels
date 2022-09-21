FROM node:16-alpine3.15

ADD ./frontend /frontend

WORKDIR /frontend
RUN npm install --silent

EXPOSE 3000
CMD [ "npm", "start" ]
