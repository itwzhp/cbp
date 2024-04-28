@allowed([ 'dev', 'prod' ])
param environment string

param location string = resourceGroup().location

// TODO zabezpieczyć bloby przed przypadkowym usunięciem
resource storageAccount 'Microsoft.Storage/storageAccounts@2021-08-01' = {
    name: 'zhpcbp${environment}store'
    location: location
    sku: {
        name: 'Standard_ZRS'
    }
    kind: 'StorageV2'

    properties:{
        minimumTlsVersion: 'TLS1_2'
    }

    resource blobService 'blobServices' = {
        name: 'default'

        resource publicContainer 'containers' = {
            name: 'public'
            properties:{
                publicAccess: 'Blob'
            }
        }

        resource imagesContainer 'containers' = {
            name: 'images'
            properties:{
                publicAccess: 'Blob'
            }
        }

        resource privateContainer 'containers' = {
            name: 'private'
            properties:{
                publicAccess: 'None'
            }
        }
    }
}

var blobEndpointHost = replace(replace(storageAccount.properties.primaryEndpoints.blob, 'https://', ''), '/', '')

resource cdn 'Microsoft.Cdn/profiles@2021-06-01' = {
    location: location
    name: '${environment}-zhp-cbp-cdn'
    sku: {
        name: 'Standard_Microsoft'
    }

    resource cdnPublicEndpoint 'endpoints' = {
        location: location
        name: 'zhp-cbp-${environment}-public'
        properties: {
            originHostHeader: blobEndpointHost
            isHttpAllowed: true
            isHttpsAllowed: true
            originPath: '/${storageAccount::blobService::publicContainer.name}'
            origins: [
                {
                    name: replace(blobEndpointHost, '.', '-')
                    properties: {
                        hostName: blobEndpointHost
                    }
                }
            ]

            deliveryPolicy: httpRedirectPolicy

            isCompressionEnabled: true
            contentTypesToCompress: contentTypesToCompress
        }
    }

    resource cdnImagesEndpoint 'endpoints' = {
        location: location
        name: 'zhp-cbp-${environment}-images'
        properties: {
            originHostHeader: blobEndpointHost
            isHttpAllowed: true
            isHttpsAllowed: true
            originPath: '/${storageAccount::blobService::imagesContainer.name}'
            origins: [
                {
                    name: replace(blobEndpointHost, '.', '-')
                    properties: {
                        hostName: blobEndpointHost
                    }
                }
            ]

            deliveryPolicy: httpRedirectPolicy

            isCompressionEnabled: true
            contentTypesToCompress: contentTypesToCompress
        }
    }
}

var httpRedirectPolicy = {
    rules: [
        {
            name: 'HttpsRedirect'
            order: 1
            conditions: [
                {
                    name: 'RequestScheme'
                    parameters: {
                        typeName: 'DeliveryRuleRequestSchemeConditionParameters'
                        operator: 'Equal'
                        negateCondition: false
                        matchValues: [
                            'HTTP'
                        ]
                        transforms: []
                    }
                }
            ]
            actions: [
                {
                    name: 'UrlRedirect'
                    parameters: {
                        typeName: 'DeliveryRuleUrlRedirectActionParameters'
                        redirectType: 'Moved'
                        destinationProtocol: 'Https'
                    }
                }
            ]
        }
    ]
}

var contentTypesToCompress = [
    'application/eot'
    'application/font'
    'application/font-sfnt'
    'application/javascript'
    'application/json'
    'application/opentype'
    'application/otf'
    'application/pkcs7-mime'
    'application/truetype'
    'application/ttf'
    'application/vnd.ms-fontobject'
    'application/xhtml+xml'
    'application/xml'
    'application/xml+rss'
    'application/x-font-opentype'
    'application/x-font-truetype'
    'application/x-font-ttf'
    'application/x-httpd-cgi'
    'application/x-javascript'
    'application/x-mpegurl'
    'application/x-opentype'
    'application/x-otf'
    'application/x-perl'
    'application/x-ttf'
    'font/eot'
    'font/ttf'
    'font/otf'
    'font/opentype'
    'image/svg+xml'
    'text/css'
    'text/csv'
    'text/html'
    'text/javascript'
    'text/js'
    'text/plain'
    'text/richtext'
    'text/tab-separated-values'
    'text/xml'
    'text/x-script'
    'text/x-component'
    'text/x-java-source'
]
