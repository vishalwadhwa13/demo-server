compile_protos:
	mkdir -p src/services
	protoc -I . --php_out=src/services \
	--grpc_out=src/services \
	--plugin=protoc-gen-grpc=bin/grpc_php_plugin protos/*.proto
