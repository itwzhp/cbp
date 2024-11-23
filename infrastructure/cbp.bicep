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
