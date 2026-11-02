```bash
docker run --name ubuntu-terraform -d -it -v ./terraform:/root/terraform ubuntu

docker exec -it ubuntu-terraform bash

mv terraform /usr/local/bin/

apt update && apt install -y curl unzip

bash install.sh --system

aws --version

aws configure

apt update && apt install -y less

aws sts get-caller-identity

terraform fmt

terraform init

terraform validate

terraform apply

terraform plan

terraform destroy
```