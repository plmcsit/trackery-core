import numpy as np
import timeit as t

def pca(X):
    """Principal Component Analysis

    input: X, matrix with training data stored as flattened arrays in rows
    return: projection matrix (with most important dimensions first).
    """
    # get dimensions
    num_data, dim = X.shape
    # center data
    mean_X = X.mean(axis=0)
    X = X - mean_X

    if dim > num_data:
        # PCA - compact trick used
        print "PCA DIMENSION REDUCTION METHOD"
        start = t.default_timer()
        M = np.dot(X,X.T) # covariance matrix
        e,EV = np.linalg.eigh(M) # eigenvalues and eigenvectors
        tmp = np.dot(X.T,EV).T # this is the compact trick
        V = tmp[::-1] # reverse since last eigenvectors are the ones we want
        S = np.sqrt(e[::-1]) # reverse since eigenvalues are in increasing order
        S = 50
        for i in range(V.shape[1]):
            V[:,i] /= S      
        stop = t.default_timer()
        end = stop - start
        print "time: {}s".format(end)
    else:
        # PCA - SVD used
        start = t.default_timer()
        print "PCA SINGLE VALUE DECOMPOSITION"
        U, S, V = np.linalg.svd(X)
        V = V[:num_data] # only makes sense to return the first num_data
        stop = t.default_timer()
        end = stop - start
        print "time: {}s".format(end)
    # return the projection matrix, the variance and the mean
    return V, S, mean_X


# PCA SINGLE VALUE DECOMPOSITION
a = np.arange(130000).reshape(2600,50)

# PCA DIMENSION REDUCTION
# a = np.arange(10000).reshape(2,5000)


v, s, mean_x = pca(a)